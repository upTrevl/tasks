<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        // Сортировка по полю name в алфавитном порядке
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'asc');
        });
    }

    protected $fillable = [
        'client_name',
        'client_phone',
        'client_org',
        'car_name',
        'car_number',
        'description',
        'create_by',
        'status'
    ];

    public function setCarNameAttribute($value)
    {
        $this->attributes['car_number'] = strtoupper($value);
    }

    public function setClientPhoneAttribute($value)
    {
        $this->attributes['client_phone'] = '+7 ' . $value;
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'id', 'create_by');
    }

    public function editor()
    {
        return $this->belongsTo('App\Models\User', 'id', 'edit_by');
    }

    public function executor()
    {
        return $this->belongsTo('App\Models\User', 'id', 'completed_by');
    }

    public  function scopeOpen($query)
    {
        return $query->where('status', 'open')->orwhere('status','process');
    }
    public  function scopeClose($query)
    {
        return $query->where('status', 'close');
    }

}
