<?php

namespace App\Enums;

enum CourieredStatusLabel: string
{
    case I = 'Issued';
    case P = 'Printed';
    case C = 'Couriered';
    case D = 'Delivered';
}