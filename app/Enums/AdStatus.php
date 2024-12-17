<?php

declare(strict_types=1);

namespace App\Enums;

enum AdStatus: string
{
    case Pending = 'pending';
    case InProgress = 'in-progress';
    case Completed = 'completed';
}
