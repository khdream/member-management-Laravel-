<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'destinationName',
        'destinationPostCode',
        'destinationLocation',
        'destinationStreetAdress',
        'destinationBuildingName',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_destination');
    }
}
