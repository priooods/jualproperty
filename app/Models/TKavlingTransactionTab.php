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
        'agent_id',
        'payment',
        'upload_ktp',
        't_kavling_tabs_id',
    ];

    public function kavling()
    {
        return $this->hasOne(TKavlingTab::class, 'id', 't_kavling_tabs_id');
    }

    public function status()
    {
        return $this->hasOne(MStatusTab::class, 'id', 'm_status_id');
    }
}
