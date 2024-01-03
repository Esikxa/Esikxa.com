<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subject extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable, Sluggable, ModelTrait, SoftDeletes;

    protected $fillable = ['uuid', 'title', 'slug', 'code', 'icon', 'popular', 'status', 'created_by', 'updated_by'];

    public function sluggable(): array
    {
        return [
            'slug' => ['source' => 'title']
        ];
    }


    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getActiveAttribute(): string
    {
        return $this->attributes['status'] == 1 ? 'Active' : 'Inactive';
    }
}
