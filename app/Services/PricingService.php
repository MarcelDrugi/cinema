<?php


namespace App\Services;

use App\Models\Pricing;

final class PricingService
{
    private $data;
    
    static $weekDays = [
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
        'Sunday',
    ];
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function updatePricing()
    {
        foreach (self::$weekDays as $day) {
            if (
                !empty($normal = $this->data[$day . 'normal']) && 
                !empty($school = $this->data[$day . 'school']) && 
                !empty($senior = $this->data[$day . 'senior'])
                ) {
                if ($pricing = Pricing::where('week_day', $day)->first()) {
                    $before = $pricing->updated_at;
                    
                    $pricing->normal = $normal;
                    $pricing->school = $school;
                    $pricing->senior = $senior;
                    $pricing->save();
                    
                    $after = $pricing->updated_at;
                    
                    if ($before != $after) {
                        $request = request();
                        $request->session()->flash('pricingModified', true);
                    }
                } else {
                    Pricing::create([
                        'week_day' => $day,
                        'normal' => $normal,
                        'school' => $school,
                        'senior' => $senior,
                    ]);
                    
                    $request = request();
                    $request->session()->flash('pricingCreated', true);
                }
            } elseif (
                empty($normal = $this->data[$day . 'normal']) &&
                empty($school = $this->data[$day . 'school']) &&
                empty($school = $this->data[$day . 'school'])
                ) {
                if ($pricing = Pricing::where('week_day', $day)->first()) {
                    $pricing->delete();
                    
                    $request = request();
                    $request->session()->flash('pricingDeleted', true);
                }
            }
        }
    }
}
    