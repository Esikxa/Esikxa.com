<?php

namespace App\Observers;

use App\Models\Subject;
use App\Repositories\SubjectRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubjectObserver
{
    protected $subject;

    public function __construct(SubjectRepository $subject)
    {
        $this->subject = $subject;
    }
    /**
     * Handle the Subject "creating" event.
     */
    public function creating(Subject $subject): void
    {
        $subject->uuid = Str::uuid();
        $subject->code = $this->generateCode();
    }
    /**
     * Handle the Subject "created" event.
     */
    public function created(Subject $subject): void
    {
        //
    }

    /**
     * Handle the Subject "updated" event.
     */
    public function updated(Subject $subject): void
    {
        //
    }

    /**
     * Handle the Subject "deleted" event.
     */
    public function deleted(Subject $subject): void
    {
        //
    }

    /**
     * Handle the Subject "restored" event.
     */
    public function restored(Subject $subject): void
    {
        //
    }

    /**
     * Handle the Subject "force deleted" event.
     */
    public function forceDeleted(Subject $subject): void
    {
        //
    }
    protected function generateCode()
    {
        return DB::transaction(function () {

            $lastCode = $this->subject->withTrashed()->orderBy('code', 'desc')->first();
            $prefix = 'SUBJECT-';
            if ($lastCode) {
                $count = (int)substr($lastCode->code, strlen($prefix));
                $count += 1;
            } else {
                $count = 1;
            }

            $count = str_pad($count, 3, '0', STR_PAD_LEFT);

            return $prefix . $count;
        });
    }
}
