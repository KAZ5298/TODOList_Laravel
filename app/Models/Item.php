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
        return Carbon::now()->format('Y-m-d');
    }

    public function getAllItemOrderByExpireDate()
    {
        return Item::orderBy('expire_date', 'asc')->get();
    }

    public function getSearchItem($search)
    {
        $searchItems = Item::where('item_name', 'LIKE', '%' . $search . '%')
            ->orwhereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            })->get();

        return $searchItems;
    }

    // public function insertItem($request)
    // {
    //     $date = getDate();
    //     $item = $request;
    //     $item->registration_date = $date;
    //     if ($request->finished_date != 1) {
    //         $item->finished_date = null;
    //     } else {
    //         $item->finished_date = $date;
    //     }

    //     dd($item, $request);

    //     // return $item->save();

    //     $item->save();
    // }

    protected $fillable = [
        'user_id',
        'item_name',
        'expire_date',
        'finished_date',
    ];
}