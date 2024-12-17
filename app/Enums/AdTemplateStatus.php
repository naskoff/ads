<?php

declare(strict_types=1);

namespace App\Enums;

enum AdTemplateStatus: string
{
    case Draft = 'draft';
    case InProgress = 'in-progress';
    case Completed = 'completed';
}
