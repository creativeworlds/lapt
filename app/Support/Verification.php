<?php

namespace App\Support;

use Illuminate\Support\Str;

class Verification
{
    /**
     * File Name Encode for QR Code
     * 
     * @param string $value
     * @return string
     */
    public static function encode(string $value): string
    {
        return Str::of($value)
            ->pipe(fn($value) => str_rot13($value))
            ->pipe(fn($value) => base64_encode($value))
            ->replace(['+', '/'], ['-', '_'])
            ->rtrim(characters: '=')
            ->value();
    }

    /**
     * QR Code Decode for File Name
     * 
     * @param string $value
     * @return string
     */
    public static function decode(string $encoded): string
    {
        return Str::of($encoded)
            ->replace(['-', '_'], ['+', '/'])
            ->pipe(fn($value) => base64_decode($value))
            ->pipe(fn($value) => str_rot13($value))
            ->value();
    }
}