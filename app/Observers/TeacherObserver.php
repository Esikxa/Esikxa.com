<?php

namespace App\Observers;

use App\Models\Teacher;
use Illuminate\Support\Str;

class TeacherObserver
{
    protected $teacher;
    public function __construct(Teacher $teacher)
    {
        $this->teacher = $teacher;
    }
    public function generateSlug($teacher)
    {
        $slug = Str::slug($teacher->user->full_name);
        if (Teacher::where('slug', $slug)->exists()) {
            $slug = $slug.'-' . Str::random(5);
        }
        return $slug;
    }
    /**
     * Handle the Teacher "creating" event.
     */
    public function creating(Teacher $teacher): void
    {
        $teacher->uuid = Str::uuid();
        $teacher->slug = $this->generateSlug($teacher);
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
