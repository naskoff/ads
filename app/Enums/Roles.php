<?php

declare(strict_types=1);

namespace App\Enums;

enum Roles: string
{
    case Viewer = 'viewer';
    case Editor = 'editor';
    case Admin = 'admin';
    case SuperAdmin = 'super-admin';
}
