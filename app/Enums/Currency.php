<?php

namespace App\Enums;

enum Currency: string
{
    case INR = 'INR';
    case GBP = 'GBP';
    case USD = 'USD';
    case EUR = 'EUR';
}