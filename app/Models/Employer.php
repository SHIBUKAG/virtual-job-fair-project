<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = [
        'companyName',
        'industry',
        'location',
        'contactName',
        'email',
        'phone',
        'website',
    ];
}
