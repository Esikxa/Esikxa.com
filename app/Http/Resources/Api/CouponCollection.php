<?php

namespace App\Http\Resources\Api;

use App\Models\CouponTransaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class CouponCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'code' => $this->code,
            'discount_value' => (float) $this->discount_value,
            'start_date_time' => $this->start_date_time,
            'end_date_time' => $this->end_date_time,
            'remaining_balance' => $this->calculateRemainingBalance($this)
        ];
    }
    public function calculateRemainingBalance($coupon)
    {
        $transactions = CouponTransaction::select(
            DB::raw('SUM(amount) as amount')
        )
            ->where('status', 1)
            ->where('coupon_id', $coupon->id)
            ->where('user_id', auth()->id())
            ->first();
       return ((float)$coupon->discount_value - (float)$transactions->amount) ?? 0;
    }
}
