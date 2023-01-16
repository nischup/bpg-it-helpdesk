<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }    

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }    

    public function priority()
    {
        return $this->belongsTo(Priority::class, 'priority_id');
    }    

    public function severity()
    {
        return $this->belongsTo(Severity::class, 'severity_id');
    }    

    public function category()
    {
        return $this->belongsTo(Category::class, 'task_category');
    }    

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }    

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }  

    public function project_module()
    {
        return $this->belongsTo(ProjectModule::class, 'module_id');
    }    

}
