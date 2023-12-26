<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityWorker extends Model
{
    use HasFactory;
    protected $fillablle = [
        'worker_id',
        'category_id',
        'count',
        'date',
        'price',
        'total_price'
    ];
    protected $guarded = [];
    public function worker()
    {
    	return $this->belongsTo(Worker::class);
    }

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
}
