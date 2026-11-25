<?php

namespace Tests\Feature;

use Tests\TestCase;

class DubaiGeoHomepageTest extends TestCase
{
    public function test_uae_browser_country_opens_the_uae_site(): void
    {
        $response = $this->withHeaders([
            'CF-IPCountry' => 'AE',
        ])->get('/');

        $response->assertRedirect(url('/').'?region=uae&auto=1');
        $this->assertSame('uae', session('market'));
        $this->assertSame('en', session('locale'));
        $this->assertSame('geo', session('market_source'));
    }

    public function test_pakistan_browser_country_opens_the_pakistan_site(): void
    {
        $response = $this->withHeaders([
            'CF-IPCountry' => 'PK',
        ])->get('/');

        $response->assertRedirect(url('/').'?region=pk&auto=1');
        $this->assertSame('pk', session('market'));
        $this->assertSame('en', session('locale'));
        $this->assertSame('geo', session('market_source'));
    }

    public function test_manual_choice_is_not_overridden_by_country(): void
    {
        $this->withSession([
            'locale' => 'en',
            'market' => 'pk',
            'market_source' => 'manual',
        ])->withHeaders([
            'CF-IPCountry' => 'AE',
        ])->get('/?region=pk');

        $this->assertSame('pk', session('market'));
        $this->assertSame('en', session('locale'));
    }

    public function test_browser_auto_region_opens_uae_without_any_geo_api(): void
    {
        $response = $this->get('/?region=uae&auto=1');

        $response->assertOk();
        $this->assertSame('uae', session('market'));
        $this->assertSame('en', session('locale'));
        $this->assertSame('geo', session('market_source'));
    }

    public function test_browser_region_cookie_opens_the_uae_site(): void
    {
        $response = $this->withUnencryptedCookie('hj_browser_region', 'uae')->get('/');

        $response->assertRedirect(url('/').'?region=uae&auto=1');
        $this->assertSame('uae', session('market'));
        $this->assertSame('geo', session('market_source'));
    }
}
