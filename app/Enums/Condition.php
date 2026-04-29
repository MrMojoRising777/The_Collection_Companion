<?php

declare(strict_types=1);

namespace App\Enums;

enum Condition: string
{
    case NEW = 'nieuwstaat';
    case ALMOST_NEW = 'bijna nieuwstaat';
    case GOOD = 'goede staat';
    case FAIR = 'redelijke staat';
    case POOR = 'slechte staat';
}
