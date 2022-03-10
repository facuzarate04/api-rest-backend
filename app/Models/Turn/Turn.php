<?php

namespace App\Models\Turn;

use App\Models\User;
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
}
