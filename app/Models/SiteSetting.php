<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['key', 'value', 'group', 'type'])]
class SiteSetting extends Model
{
    /**
     * Retrieve a setting value by key.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();

        if (! $setting) {
            return $default;
        }

        if ($setting->type === 'boolean') {
            return filter_var($setting->value, FILTER_VALIDATE_BOOLEAN);
        }

        if ($setting->type === 'json') {
            return json_decode($setting->value, true) ?: $default;
        }

        if ($setting->type === 'integer') {
            return (int) $setting->value;
        }

        return $setting->value ?? $default;
    }

    /**
     * Set a setting value.
     */
    public static function set(string $key, mixed $value, string $group = 'general', string $type = 'text'): static
    {
        if (is_array($value) || is_object($value)) {
            $value = json_encode($value);
            $type = 'json';
        } elseif (is_bool($value)) {
            $value = $value ? '1' : '0';
            $type = 'boolean';
        }

        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => (string) $value,
                'group' => $group,
                'type' => $type,
            ]
        );
    }

    /**
     * Get all settings as key => value array.
     */
    public static function allKeyed(): array
    {
        return static::all()->mapWithKeys(function (self $setting) {
            $val = $setting->value;
            if ($setting->type === 'boolean') {
                $val = filter_var($val, FILTER_VALIDATE_BOOLEAN);
            } elseif ($setting->type === 'json') {
                $val = json_decode($val, true);
            }

            return [$setting->key => $val];
        })->all();
    }
}
