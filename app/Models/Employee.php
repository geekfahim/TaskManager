<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    CONST STATUSES = [1=>'Full-Time',2=>'Part-Time',3=>'Contract',4=>'Retired'];

}
