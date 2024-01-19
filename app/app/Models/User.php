<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;


    protected $fillable = [
        'name','password','email','role_id',
    ];
    protected $guarded=[];
    public function role():BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public $hidden = [
        'password'
    ];
}
