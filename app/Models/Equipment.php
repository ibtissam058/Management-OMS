<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = ['name', 'type', 'location', 'status', 'last_maintenance'];

    public function workOrders() {
        return $this->hasMany(WorkOrder::class);
    }
}
