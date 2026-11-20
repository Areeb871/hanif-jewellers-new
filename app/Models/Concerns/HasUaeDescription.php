<?php

namespace App\Models\Concerns;

trait HasUaeDescription
{
    public function displayDescription(): string
    {
        $arabic = trim(strip_tags((string) ($this->uae_description ?? '')));

        if (app()->getLocale() === 'ar' && $arabic !== '') {
            return (string) $this->uae_description;
        }

        return (string) ($this->description ?? '');
    }
}
