<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrushPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'partner_id',
        'payments',
        'required',
        'date',
        'statment',
        'received_id',
        'state'
    ];
    
    public function partner()
    {
    	return $this->belongsTo(Partner::class);
    }

    public function received()
    {
        return $this->belongsTo('App\Models\Partner', 'received_id', 'id');
    }

}
