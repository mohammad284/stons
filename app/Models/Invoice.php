<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'partner_id',
        'subject_id',
        'count',
        'price',
        'total_price',
        'date',
        'statment',
        'state'
    ];


    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'subject_id', 'id');
    }
    public function partner()
    {
    	return $this->belongsTo(Partner::class);
    }
}
