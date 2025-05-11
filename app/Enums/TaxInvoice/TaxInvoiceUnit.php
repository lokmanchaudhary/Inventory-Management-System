<?php

namespace App\Enums\TaxInvoice;

enum TaxInvoiceUnit: string
{
    case PCS     = 'pcs';
    case PKT     = 'pkt';
    case KG      = 'kg';
    case G       = 'g';
    case BOX     = 'box';
    case CARTON  = 'carton';
    case DOZEN   = 'dozen';
    case ROLL    = 'roll';
    case SET     = 'set';
}
