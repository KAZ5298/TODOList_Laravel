<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $now = Carbon::now();
        $date = $now->format('Y-m-d');

        $loginUser = auth()->user();

        // 通常の一覧表示か、検索結果か
        $search = $request->input('search');
        if (empty($search)) {
            $items = Item::orderBy('expire_date', 'asc')->get();
        } else {
            $items = Item::query()->where('item_name', 'LIKE', '%' . $search . '%')->get();
        }

        return view('item.index', compact('date', 'items', 'loginUser', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $now = Carbon::now();
        $date = $now->format('Y-m-d');

        $users = User::all();
        $loginUser = auth()->user();
        return view('item.create', compact('date', 'users', 'loginUser'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $inputs = $request->validated();

        $now = Carbon::now();
        $date = $now->format('Y-m-d');

        $item = new Item();
        $item->user_id = $inputs['user_id'];
        $item->item_name = $inputs['item_name'];
        $item->registration_date = $date;
        $item->expire_date = $inputs['expire_date'];
        if (isset($request->finished_date)) {
            $item->finished_date = $date;
        } else {
            $item->finished_date = null;
        }

        $item->save();

        return redirect()->route('item.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $loginUser = auth()->user();
        $users = User::all();

        return view('item.edit', compact('item', 'loginUser', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, Item $item)
    {
        $inputs = $request->validated();

        $now = Carbon::now();
        $date = $now->format('Y-m-d');

        $item->user_id = $inputs['user_id'];
        $item->item_name = $inputs['item_name'];
        $item->expire_date = $inputs['expire_date'];
        if (isset($request->finished_date)) {
            $item->finished_date = $date;
        } else {
            $item->finished_date = null;
        }

        $item->save();

        return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->is_deleted = 1;
        $item->save();

        return redirect()->route('item.index');
    }

    public function delete(Item $item)
    {
        $loginUser = auth()->user();

        return view('item.delete', compact('item', 'loginUser'));
    }

    public function complete(Item $item)
    {
        $now = Carbon::now();
        $date = $now->format('Y-m-d');

        $item->finished_date = $date;

        $item->save();

        return redirect()->route('item.index');
    }
}
