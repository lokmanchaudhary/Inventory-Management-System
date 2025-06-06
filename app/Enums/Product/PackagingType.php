<?php

namespace App\Enums\Product;

enum PackagingType: string
{
    case BOX = 'box';
    case BUNDLE = 'bundle';
    case STRIPE = 'stripe';
    case PACKET = 'packet';
    case BOTTLE = 'bottle';
    case CAN = 'can';
    case JAR = 'jar';
    case POUCH = 'pouch';
    case TUBE = 'tube';
    case ROLL = 'roll';
    case SACHET = 'sachet';
    case CRATE = 'crate';
    case TRAY = 'tray';
    case CARTON = 'carton';
    case LOOSE = 'loose';

    public function label(): string
    {
        return match($this) {
            self::BOX => 'Box',
            self::BUNDLE => 'Bundle',
            self::STRIPE => 'Stripe',
            self::PACKET => 'Packet',
            self::BOTTLE => 'Bottle',
            self::CAN => 'Can',
            self::JAR => 'Jar',
            self::POUCH => 'Pouch',
            self::TUBE => 'Tube',
            self::ROLL => 'Roll',
            self::SACHET => 'Sachet',
            self::CRATE => 'Crate',
            self::TRAY => 'Tray',
            self::CARTON => 'Carton',
            self::LOOSE => 'Loose',
        };
    }
}
