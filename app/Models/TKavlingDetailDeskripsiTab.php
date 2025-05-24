<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TKavlingDetailDeskripsiTab extends Model
{
    public $timestamps = false;
    protected $fillable = [
        't_kavling_tabs_id',
        'description'
    ];
}
