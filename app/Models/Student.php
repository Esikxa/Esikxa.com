<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable, ModelTrait, SoftDeletes;

    protected $fillable = ['uuid', 'user_id', 'grade', 'country', 'institute', 'expected_tution_fee', 'major_subjects', 'preferred_shift', 'preferred_time_start', 'preferred_time_end', 'additional_info', 'accept_term_condition', 'status', 'created_by', 'updated_by'];


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
