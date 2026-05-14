<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CurrencyController extends Controller
{
    protected const SUPPORTED = ['PKR', 'AED'];

    public function set(Request $request): RedirectResponse
    {
        $request->validate([
            'currency' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!in_array(Str::upper($value), self::SUPPORTED, true)) {
                    $fail('Invalid currency selected.');
                }
            }],
        ]);

        $currency = Str::upper($request->string('currency'));
        session(['currency' => $currency]);

        return back();
    }
}

