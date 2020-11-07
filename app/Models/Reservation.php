<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'screening_id',
        'user_id',
        'payment_status',
        'price',
        'tickets_number'
    ];
    
    public function screening()
    {
        return $this->belongsTo('App\Models\Screening');
    }
    
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
}
