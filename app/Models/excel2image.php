<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class excel2image extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_address',
        'address_verification_status',
        'house_picture',
        'gps',
        'gps_latitude',
        'gps_longitude',
        'gps_altitude',
        'gps_precision',
        'landmark_description',
        'comment',
        'contact_person',
        'verification_officer_name',
        'verification_date',
    ];
}
