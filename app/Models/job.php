<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Companyuser;

class job extends Model
{
    use HasFactory;
    use softDeletes;
    // protected $fillable = [
    //     'company_id',
    //     'company_name',
    //     'job_position',
    //     'job_description',
    //     'basic_qualification',
    //     'skills_required',
    //     'application_start_date',
    //     'application_end_date',
    //     'status',
    // ];
    protected $guarded=[];
    public function companyuser()
    {
        return $this->belongsTo(Companyuser::class, 'company_id');
    }
}
