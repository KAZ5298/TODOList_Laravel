<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Item extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDate()
    {
        $date = Carbon::now()->format('Y-m-d');
        return $date;
    }

    protected $fillable = [
        'user_id',
        'item_name',
        'expire_date',
    ];
}
