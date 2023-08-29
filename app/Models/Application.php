<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_posting_id',
        'user_id',
    ];

    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class, 'job_posting_id');
    }


    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class, 'user_id');
    }   
}
