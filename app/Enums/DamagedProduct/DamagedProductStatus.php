<?php

namespace App\Enums\DamagedProduct;

enum DamagedProductStatus: string
{
    case PENDING = 'pending';
    case REFUNDED = 'refunded';
    case EXCHANGED = 'exchanged';
}
