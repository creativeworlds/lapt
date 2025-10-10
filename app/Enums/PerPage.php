<?php

namespace App\Enums;

enum PerPage: int
{
    case A = 20;
    case B = 50;
    case C = 100;
    case D = 200;
    case E = 500;
    case F = 1000;
    case G = 3000;
    case H = 5000;
}