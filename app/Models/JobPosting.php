<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    protected $fillable = [
        'employer_id',
        'job_title',
        'company_name',
        'job_type',
        'estimated_salary',
        'salary_type',
        'job_description',
        'location',
        'required_skills',
        'status'
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }


}
