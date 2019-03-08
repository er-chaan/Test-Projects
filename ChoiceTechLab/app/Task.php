<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = ['task_name','start_date','end_date','duration','dependancy_task',
                            'dependancy_condition','dependancy_days','description','status'];
}
