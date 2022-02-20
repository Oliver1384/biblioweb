<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestLoan extends Model {
    use HasFactory;
    protected $fillable = [
        'book_loan_id',
        'user_loan_id',
    ];
}
