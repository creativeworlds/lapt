<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

/** QR Code External Library */
class QRCode
{
    /** 
     * QR Code file Storage Path 
     * 
     * @var string
     */
    protected $path;

    /** 
     * QR Code file URL 
     * 
     * @var string
     */
    protected $url;

    /** 
     * Genrate QR Code PNG Image 
     * 
     * @param  string  $text
     * @return $this 
     */
    public function generate($text): self
    {
        // genrate qrcode storage path
        $this->path = Storage::disk('public')->path("qrcode/qrcode_" . time() . ".png");

        // genrate qrcode url
        $this->url = Storage::disk('public')->url("qrcode/qrcode_" . time() . ".png");

        // genrate qr code png image
        \QRcode::png($text, $this->path);

        return $this;
    }

    /**
     * Get genrated qrcode storage path
     * 
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get genrated qrcode url
     * 
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /** 
     * Delete the generated qrcode image 
     *
     * @return bool 
     */
    public function delete()
    {
        return unlink($this->path);
    }
}