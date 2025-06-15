<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TKavlingTransactionTab extends Model
{
    protected $fillable = [
        'name',
        'order_id',
        'm_status_id',
        'nomor_ktp',
        'nomor_kk',
        'nomor_hp',
        'email',
        'upload_ktp',
        't_kavling_tabs_id',
    ];
}
