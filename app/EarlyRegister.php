<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EarlyRegister extends Model
{
    //protect the table to allow mass assignment
    protected $table = 'early_registers';
    protected $fillable = [
        'nm_student',
        'sch_student',
        'mjr_student_ft',
        'mjr_student_snd',
        'phn_student',
        'phn_parent',
        'addrs_student',
        'status'
    ];
}
