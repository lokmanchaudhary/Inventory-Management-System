<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = [
        "company_name",
        "contact_person",
        "email",
        "phone",
        "address",
        "pan_no",
    ];
}
