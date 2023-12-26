<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrusherInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'partner_id',
        'driver',
        'wight',
        'subject',
        'price',
        'total_price',
        'date',
        'note'
    ];

    public function subject()
    {
    	return $this->belongsTo(Subject::class);
    }

    public function partner()
    {
    	return $this->belongsTo(Partner::class);
    }
}
