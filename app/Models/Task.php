<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =['title','due_date','duration','type'];

    CONST TYPE = [1=>'call',2=>'deadline',3=>'email',4=>'meeting'];
    CONST STATUSES = [1=>'Ongoing',2=>'Due',3=>'Delayed',4=>'Completed'];

    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
        'due_date' => 'datetime:Y-m-d',
        'type' => 'integer'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
