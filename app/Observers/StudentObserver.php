<?php

namespace App\Observers;

use App\Models\Student;
use Illuminate\Support\Str;

class StudentObserver
{
    protected $student;
    public function __construct(Student $student)
    {
        $this->student = $student;
    }
    public function generateSlug($student)
    {
        $slug = Str::slug($student->user->full_name);
        if (Student::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . Str::random(5);
        }
        return $slug;
    }
    /**
     * Handle the Student "creating" event.
     */
    public function creating(Student $student): void
    {
        $student->uuid = Str::uuid();
        $student->slug = $this->generateSlug($student);
    }
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }
}
