<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Role extends Model
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $table = "role";
    protected $fillable = ['name'];
    public function getName(){

    return $this->name;
    }
    public function users(): HasMany{

        return $this->hasMany(User::class);
    }
}
