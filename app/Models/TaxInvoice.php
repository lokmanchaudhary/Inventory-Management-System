<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxInvoice extends Model
{
    protected $fillable = [
        "seller_id",
        "invoice_number",
        "invoice_date",
        "payment_type",
        "product_name",
        "hs_code",
        "unit",
        "pack",
        "pcs",
        "price",
        "discount",
        "type",
        "amount",
        "total_pack_quantity",
        "sub_total",
        "discount_total",
        "ebf_vat_amount",
        "vat",
        "net_total",
    ];
}
