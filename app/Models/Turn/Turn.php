<?php

namespace App\Models\Turn;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'date',
        'duration'
    ];

    //RELATIONSHIPS

    public function client()
    {
        return $this->belongsTo(User::class);
    }

    //FORMAT ATTRIBUTES

    public function getdateClientAttribute()
    {
        return Carbon::parse($this->date)->format('d-m-Y');
    }

    public function getMonthAttribute()
    {
        return Carbon::parse($this->date)->month;
    }

}
