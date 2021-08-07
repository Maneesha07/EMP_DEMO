<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "employees";
    protected $fillable = ['name','email','password','image','designation_id'];
    /**
     * Get the designation associated with the employee.
     */
    public function designation()
    {
        return $this->hasOne('App\Designation', 'id', 'designation_id');
    }
    public function image()
    {
        return 'employee/img/'.$this->image;
    }
}
