<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\job;

class Companyuser extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'company_email',
        'company_password',
    ];
    public function jobs()
    {
        return $this->hasMany(job::class, 'company_id');
    }
 
}
