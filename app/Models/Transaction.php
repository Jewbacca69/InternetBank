<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['sender_id', 'recipient_id','recipient_account_number', 'sender_account_number', 'amount', 'type'];
    protected $table = 'transactions';
}
