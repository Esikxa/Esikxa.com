<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait ModelTrait
{
    public static function bootModelTrait()
    {
        static::creating(function ($model) {
            if (auth('admin')->check()) {
                $model->created_by = $model->created_by == null ? Auth::guard('admin')->user()->id : $model->created_by;
            }
        });

        static::updating(function ($model) {
            if (auth('admin')->check()) {
                $model->updated_by = Auth::guard('admin')->user()->id;
            }
        });
    }
}
