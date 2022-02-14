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

    protected $casts = [
        'due_date' => 'datetime:Y-m-d',
        'type' => 'integer'
    ];

}
