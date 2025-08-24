<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    protected $fillable = ['equipment_id', 'description', 'priority', 'status', 'technician_id', 'due_date', 'cost'];

    public function equipment() {
        return $this->belongsTo(Equipment::class);
    }

    public function technician() {
        return $this->belongsTo(Technician::class);
    }
}
