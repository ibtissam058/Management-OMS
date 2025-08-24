<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    protected $fillable = ['name', 'speciality', 'email','phone_number'];

    public function workOrders(){
        return $this->hasMany(WorkOrder::class);
    }
}
