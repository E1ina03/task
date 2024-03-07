<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Weather extends Model
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $table = 'weather';
    protected $fillable = ['city', 'temperature'];
}
