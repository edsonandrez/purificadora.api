<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //

    protected $primaryKey = 'id';
    protected $table = 'inventory';
    public $timestamps = false;

    protected $dates = [
        'movement_date'
    ];

    public function visit_document()
    {
        return $this->belongsTo(CarboyMovement::class, 'document_id', 'visit_id');

    }

}
