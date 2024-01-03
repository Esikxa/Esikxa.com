<?php

namespace App\Observers;

use App\Helpers\ConstantHelper;
use App\Models\Module;
use App\Repositories\ModuleRepository;
use Illuminate\Support\Str;

class ModuleObserver
{
    protected $module;

    public function __construct(ModuleRepository $module)
    {
        $this->module = $module;
    }
    /**
     * Handle the Module "creating" event.
     */
    public function creating(Module $module): void
    {
        $module->uuid = Str::uuid();
        $module->code = $this->generateCode();
    }
    /**
     * Handle the Module "created" event.
     */
    public function created(Module $module): void
    {
        //
    }

    /**
     * Handle the Module "updated" event.
     */
    public function updated(Module $module): void
    {
        //
    }

    /**
     * Handle the Module "deleted" event.
     */
    public function deleted(Module $module): void
    {
        //
    }

    /**
     * Handle the Module "restored" event.
     */
    public function restored(Module $module): void
    {
        //
    }

    /**
     * Handle the Module "force deleted" event.
     */
    public function forceDeleted(Module $module): void
    {
        //
    }

    protected function generateCode()
    {
        $count = $this->module->withTrashed()->count();
        do {
            $count += 1;
            $count = str_pad($count, 5, 0, STR_PAD_LEFT);
            $code = ConstantHelper::MODULE_CODE_PREFIX . $count;
            if (!$this->module->withTrashed()->where('code', $code)->first()) {
                return $code;
            }
        } while (true);
    }
}
