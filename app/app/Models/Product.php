<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Product extends Model
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $guarded = [];

    protected $fillable = [
        'id', 'product_name', 'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
