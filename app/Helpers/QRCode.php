<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

/** QR Code External Library */
class QRCode
{
    /** QR Code file Storage Path */
    public string $path;

    /** QR Code file URL */
    public string $url;

    /** Genrate QR Code PNG Image */
    public static function generate($text)
    {
        /** Genrate QR Code Storage Path */
        $path = Storage::disk('public')->path("qrcode/qrcode_" . time() . ".png");

        /**Genrate QR Code URL */
        $url = Storage::disk('public')->url("qrcode/qrcode_" . time() . ".png");

        // genrate qr code png image
        \QRcode::png($text, $path);

        $instance = new self();
        $instance->path = $path;
        $instance->url = $url;

        return $instance;
    }

    /** Delete the generated QR code Image */
    public function delete(): bool
    {
        return Storage::disk('public')->delete($this->path);
    }
}