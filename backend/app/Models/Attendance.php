<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\Client;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'dateservice',
        'hour',
        'service_id',
        'client_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
