<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'partner_id',// من مين مشتري بضاعة
        'required',// شو مطلوب مني ادفع
        'payments',// شو دفعت
        'date',//التاريخ
        'statment',//البيان
        'state'// الحالة داخل او خارج
    ];
    public function partner()
    {
    	return $this->belongsTo(Partner::class);
    }
}
