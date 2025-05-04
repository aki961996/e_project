<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionItem extends Model
{
    use HasFactory;
    protected $table = 'requisition_items';

    protected $fillable = [
        'event_id',
        'item',
        'is_gift',
        'claimed',
        'claimed_by',
        'visibility',
    ];
}
