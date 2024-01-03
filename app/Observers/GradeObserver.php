<?php

namespace App\Observers;

use App\Models\Grade;
use App\Repositories\GradeRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GradeObserver
{
    protected $grade;

    public function __construct(GradeRepository $grade)
    {
        $this->grade = $grade;
    }
    /**
     * Handle the Grade "creating" event.
     */
    public function creating(Grade $grade): void
    {
        $grade->uuid = Str::uuid();
        $grade->code = $this->generateCode();
    }
    /**
     * Handle the Grade "created" event.
     */
    public function created(Grade $grade): void
    {
        //
    }

    /**
     * Handle the Grade "updated" event.
     */
    public function updated(Grade $grade): void
    {
        //
    }

    /**
     * Handle the Grade "deleted" event.
     */
    public function deleted(Grade $grade): void
    {
        //
    }

    /**
     * Handle the Grade "restored" event.
     */
    public function restored(Grade $grade): void
    {
        //
    }

    /**
     * Handle the Grade "force deleted" event.
     */
    public function forceDeleted(Grade $grade): void
    {
        //
    }

    protected function generateCode()
    {
        return DB::transaction(function () {

            $lastCode = $this->grade->withTrashed()->orderBy('code', 'desc')->first();
            $prefix = 'GRADE-';
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
