<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_phone',
        'client_org',
        'car_name',
        'car_number',
        'description',
        'create_by',
    ];

    public function creator()
    {
        return $this->belongsTo('App\Models\User','id','create_by');
    }
    public function editor()
    {
        return $this->belongsTo('App\Models\User','id','edit_by');
    }
    public function executor()
    {
        return $this->belongsTo('App\Models\User','id','completed_by');
    }
}
