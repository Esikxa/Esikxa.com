<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

class RolePermission extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable, ModelTrait;

    protected $table = 'role_permissions';

    protected $dateFormat = 'Y-m-d H:i:s.u';

    protected $fillable = [
        'uuid', 'role_id', 'permission_id', 'created_by', 'updated_by'
    ];

    public function roleId(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function permissionId(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'permission_id');
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
