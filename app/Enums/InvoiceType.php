<?php

namespace App\Enums;

enum InvoiceType: string
{
    case STUDENT = 'student';
    case ACCREDITATION = 'accreditation';
}