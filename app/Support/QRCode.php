<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
     * QR Code Image File Path
     * 
     * @var string
     */
    protected $filePath;

    /**
     * Set the QR context (usually a URL or text)
     * 
     * @param string $context
     * @return $this
     */
    public function url($context): self
    {
        /** Context File Name */
        $fileName = Str::beforeLast($context, '.');

        /** Verfication Encoded File Name */
        $encodeFileName = Verification::encode($fileName);

        // genrate url for qrcode
        $this->url = route('verify', $encodeFileName);

        return $this;
    }

    /** 
     * Genrate QR Code PNG Image 
     * 
     * @param string $context
     * @return $this 
     */
    public function generate(?string $context = null): self
    {
        // create qrcode folder
        Storage::disk('public')->makeDirectory('qrcode');

        // qrcode image file path
        $this->filePath = "qrcode/qrcode_" . time() . ".png";

        // genrate qrcode storage path
        $this->path = Storage::disk('public')->path($this->filePath);

        // genrate qr code png image
        \QRcode::png($context ?? $this->url, $this->path);

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
        return Storage::disk('public')->delete($this->filePath);
    }
}