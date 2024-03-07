<?php

declare(strict_types=1);

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
