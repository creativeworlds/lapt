<?php

namespace App\Support\Facades;

use Illuminate\Support\Facades\Facade;

/** 
 * @see \App\Support\QRCode
 */
class QRCode extends Facade
{
    /**
     * Get the Registered name of the component
     * 
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return "qrcode";
    }
}