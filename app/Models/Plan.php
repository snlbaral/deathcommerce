<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PlanOrder;
use App\Models\PlanPrice;
use App\Models\User;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'price',
        'duration',
        'max_stores',
        'max_products',
        'max_users',
        'enable_custdomain',
        'enable_custsubdomain',
        'additional_page',
        'blog',
        'shipping_method',
        'image',
        'description',
        'pwa_store',
        'trial_days',
        'status',
    ];

    public static $arrDuration = [
        'Lifetime' => 'Lifetime',
        'Month' => 'Per Month',
        'Year' => 'Per Year',
    ];

    public function status()
    {
        return [
            __('Lifetime'),
            __('Per Month'),
            __('Per Year'),
        ];
    }

    public function getPlanPrice() {
        $planPrice = PlanPrice::where('plan_id','=',$this->id)->where('country','=','Default')->first();
        return $planPrice;
    }

    public function defaultMonthlyPrice() {
        $planPrice = PlanPrice::where('plan_id','=',$this->id)->where('country','=','Default')->first();
        if($planPrice) {
            return $planPrice->monthly;
        }
        return $this->price;
    }
    public function defaultYearlyPrice() {
        $planPrice = PlanPrice::where('plan_id','=',$this->id)->where('country','=','Default')->first();
        if($planPrice) {
            return $planPrice->yearly;
        }
        return $this->price;
    }

    public function getPlanStatus() {
        return $this->status === 0 ? "Inactive" : "Active";
    }

    public static function total_plan()
    {
        return Plan::count();
    }

    public static function most_purchese_plan()
    {
        $free_plan = Plan::where('price', '<=', 0)->first()->id;

        return User:: select('plans.name', 'plans.id', \DB::raw('count(*) as total'))->join('plans', 'plans.id', '=', 'users.plan')->where('type', '=', 'owner')->where('plan', '!=', $free_plan)->orderBy('total', 'Desc')->groupBy('plans.name', 'plans.id')->first();
    }

    public function transkeyword()
    {
        $arr = [
            __('Per Month'),
            __('Per Year'),
            __('Year'),
        ];
    }

    public function get_plan_orders_count()
    {
        return PlanOrder::where('plan_id', $this->id)->count();
    }
    public function get_plan_users_count()
    {
        return User::where('plan', $this->id)->count();
    }
}
