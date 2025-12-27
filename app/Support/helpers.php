<?php

use App\Models\CompanySetting;

if (! function_exists('setting')) {
    function setting(string $key, mixed $fallback = null): mixed
    {
        static $settings = null;

        if ($settings === null) {
            $settings = CompanySetting::query()->first();
        }

        $value = $settings?->{$key};

        if ($value === null || $value === '') {
            return $fallback;
        }

        return $value;
    }
}
