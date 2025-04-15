<?php

namespace App\Enums;

enum DamagedProductStatus: string
{
    case PENDING = 'pending';
    case REFUNDED = 'refunded';
    case EXCHANGED = 'exchanged';
}
