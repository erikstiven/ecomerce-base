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
        'about_title',
        'about_intro',
        'about_who',
        'about_differentials',
        'about_process',
        'location_title',
        'location_description',
        'location_map_embed',
        'location_address',
        'location_hours',
        'location_email',
        'location_phone_primary',
        'location_phone_secondary',
        'location_phone_sales',
        'location_contact_text',
        'faq_title',
        'faq_content',
        'legal_terms_content',
        'legal_privacy_content',
        'legal_returns_content',
    ];
}
