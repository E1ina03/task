<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $table = 'company';
    protected $fillable =
        [
            'name','status','phone',
        ];
    protected $guarded=[];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

}
