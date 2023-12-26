<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'mobile',
        'status',
        'percentage'
    ];


    public function payments()
    {
        return $this->hasMany('App\Models\CrushPayment', 'partner_id', 'id');
    }
}
