<?php

declare(strict_types=1);

namespace App\Enums;

enum Permissions: string
{
    case AdsView = 'ads.view';
    case AdsCreate = 'ads.create';
    case AdsUpdate = 'ads.update';
    case AdsDelete = 'ads.delete';

    case AdsTemplateView = 'ads.template.view';
    case AdsTemplateCreate = 'ads.template.create';
    case AdsTemplateUpdate = 'ads.template.update';
    case AdsTemplateDelete = 'ads.template.delete';

    case SystemView = 'system.view';
    case SystemCreate = 'system.create';
    case SystemUpdate = 'system.update';
    case SystemDelete = 'system.delete';
}
