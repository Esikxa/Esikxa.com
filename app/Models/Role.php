<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable, Sluggable, ModelTrait, SoftDeletes;

    protected $table = 'roles';

    protected $dateFormat = 'Y-m-d H:i:s.u';

    protected $fillable = [
        'uuid', 'code', 'title', 'slug', 'client_id', 'status', 'created_by', 'updated_by'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title', 'client_id']
            ]
        ];
    }
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, RolePermission::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, UserRole::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
