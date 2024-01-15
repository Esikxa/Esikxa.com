<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SiteSetting extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable, ModelTrait, SoftDeletes;

    protected $fillable = [
        'type', 'title', 'slug','excerpt', 'value', 'created_by', 'updated_by'
    ];

    public const SETTINGS  = [
        [
            'title' => 'Site Name',
            'slug' => 'site_name',
            'type' => 'general',
            'form-type' => 'text'
        ],
        [
            'title' => 'Logo',
            'slug' => 'logo',
            'type' => 'general',
            'form-type' => 'file'
        ],
        [
            'title' => 'Favicon',
            'slug' => 'favicon',
            'type' => 'general',
            'form-type' => 'file'
        ],
        [
            'title' => 'Email Address',
            'slug' => 'email_address',
            'type' => 'general',
            'form-type' => 'email'
        ],
        [
            'title' => 'Phone Number',
            'slug' => 'phone_number',
            'type' => 'general',
            'form-type' => 'text'
        ],
        [
            'title' => 'Opening Time',
            'slug' => 'opening_time',
            'type' => 'general',
            'form-type' => 'text'
        ],
        [
            'title' => 'Address',
            'slug' => 'address',
            'type' => 'general',
            'form-type' => 'text'
        ],
        [
            'title' => 'Facebook',
            'slug' => 'facebook',
            'type' => 'general',
            'form-type' => 'text'
        ],
        [
            'title' => 'Twitter',
            'slug' => 'twitter',
            'type' => 'general',
            'form-type' => 'text'
        ],
        [
            'title' => 'Instagram',
            'slug' => 'instagram',
            'type' => 'general',
            'form-type' => 'text'
        ],
        [
            'title' => 'LinkedIn',
            'slug' => 'linkedin',
            'type' => 'general',
            'form-type' => 'text'
        ],
        [
            'title' => 'Youtube',
            'slug' => 'youtube',
            'type' => 'general',
            'form-type' => 'text'
        ],
        [
            'title' => 'Google Map',
            'slug' => 'google_map',
            'type' => 'general',
            'form-type' => 'text'
        ],

    ];
}
