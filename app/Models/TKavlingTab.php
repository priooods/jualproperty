<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TKavlingTab extends Model
{
    protected $fillable = [
        'm_status_tabs_id',
        'm_status_tabs_transaction_id',
        'm_type_kavling_tabs_id',
        'title',
        'size',
        'price',
        'down_payment',
        'address',
    ];

    public function status()
    {
        return $this->hasOne(MStatusTab::class, 'id', 'm_status_tabs_id');
    }

    public function status_kavling()
    {
        return $this->hasOne(MStatusTab::class, 'id', 'm_status_tabs_transaction_id');
    }

    public function type()
    {
        return $this->hasOne(MTypeKavlingTab::class, 'id', 'm_type_kavling_tabs_id');
    }

    public function description()
    {
        return $this->hasMany(TKavlingDetailDeskripsiTab::class, 't_kavling_tabs_id', 'id');
    }

    public function facility()
    {
        return $this->hasMany(TKavlingDetailFacilityTab::class, 't_kavling_tabs_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(TKavlingDetailImagesTab::class, 't_kavling_tabs_id', 'id');
    }
}
