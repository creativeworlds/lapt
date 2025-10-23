<?php

namespace App\Enums;

enum TaxType: string
{
    case GST = 'GST';
    case VAT = 'VAT';
    case NONE = 'None';
}