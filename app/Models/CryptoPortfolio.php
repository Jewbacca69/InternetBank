<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CryptoPortfolio extends Model
{
    use HasFactory;
    protected $fillable = ['owner_id', 'crypto_id', 'crypto_address', 'balance'];
    protected $table = 'crypto_portfolio';

    public function crypto(): BelongsTo
    {
        return $this->belongsTo(Crypto::class, 'crypto_id');
    }
}
