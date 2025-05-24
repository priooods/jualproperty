<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TKavlingDetailImagesTab extends Model
{
    public $timestamps = false;
    protected $fillable = [
        't_kavling_tabs_id',
        'path'
    ];
}
