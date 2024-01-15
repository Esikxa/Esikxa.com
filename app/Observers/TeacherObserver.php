<?php

namespace App\Observers;

use App\Models\Teacher;
use Illuminate\Support\Str;

class TeacherObserver
{
    /**
     * Handle the Teacher "creating" event.
     */
    public function creating(Teacher $teacher): void
    {
        $teacher->uuid = Str::uuid();
    }
    /**
     * Handle the Teacher "created" event.
     */
    public function created(Teacher $teacher): void
    {
        //
    }

    /**
     * Handle the Teacher "updated" event.
     */
    public function updated(Teacher $teacher): void
    {
        //
    }

    /**
     * Handle the Teacher "deleted" event.
     */
    public function deleted(Teacher $teacher): void
    {
        //
    }

    /**
     * Handle the Teacher "restored" event.
     */
    public function restored(Teacher $teacher): void
    {
        //
    }

    /**
     * Handle the Teacher "force deleted" event.
     */
    public function forceDeleted(Teacher $teacher): void
    {
        //
    }
}
