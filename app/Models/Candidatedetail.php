<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidatedetail extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function academicdetails()
    {
        return $this->hasOne(Academicdetail::class);
    }
    
    public function experiendetails()
    {
        return $this->hasMany(Experiendetail::class);
    }
}
