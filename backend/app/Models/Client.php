<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;

class Client extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'email',
        'datebirth',
        'adress',
        'zipcode',
        'city'
    ];

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
}
