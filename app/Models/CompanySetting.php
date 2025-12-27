<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $fillable = [
        'name',
        'footer_description',
        'footer_email',
        'footer_phone',
        'footer_logo',
        'facebook',
        'instagram',
        'tiktok',
        'youtube',
        'legal_company_name',
    ];
}
