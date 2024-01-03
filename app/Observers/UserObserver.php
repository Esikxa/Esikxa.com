<?php

namespace App\Observers;

use App\Helpers\ConstantHelper;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserObserver
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the User "creating" event.
     */
    public function creating(User $user): void
    {
        $user->uuid = Str::uuid();
        $user->code = $this->generateCode($user->type);
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }

    protected function generateCode($type = ConstantHelper::USER_TYPE_STUDENT)
    {
        return DB::transaction(function () use ($type) {
            $prefix = '';

            switch ($type) {
                case 1:
                    $prefix = ConstantHelper::ADMIN_CODE_PREFIX;
                    break;
                case 2:
                    $prefix = ConstantHelper::STUDENT_CODE_PREFIX;
                    break;
                case 3:
                    $prefix = ConstantHelper::TEACHER_CODE_PREFIX;
                    break;
                default:
                    $prefix = 'US-';
                    break;
            }

            $lastCode = $this->user->withTrashed()->where('code', 'like', $prefix . '%')->orderBy('code', 'desc')->first();

            if ($lastCode) {
                $count = (int)substr($lastCode->code, strlen($prefix));
                $count += 1;
            } else {
                $count = 1;
            }

            $count = str_pad($count, 7, '0', STR_PAD_LEFT);

            return $prefix . $count;
        });
    }
  
}
