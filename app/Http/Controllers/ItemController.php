<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::orderBy('expire_date', 'asc')->get();
        $user = auth()->user();
        return view('todo.index', compact('items', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $now = Carbon::now();
        $date = $now->format('Y-m-d');

        $users = User::all();
        $user = auth()->user();
        return view('todo.create', compact('date', 'users', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $now = Carbon::now();
        $date = $now->format('Y-m-d');

        $item = new Item();
        $item->user_id = $request->user_id;
        $item->item_name = $request->item_name;
        $item->registration_date = $date;
        $item->expire_date = $request->expire_date;
        if (isset($request->finished_date)) {
            $item->finished_date = $date;
        } else {
            $item->finished_date = null;
        }

        $item->save();
        return redirect('./todo');
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
    public function edit($id)
    {
        $item = Item::find($id);
        $loginUser = auth()->user();
        $users = User::all();

        return view('todo.edit', compact('item', 'loginUser', 'users'));
    }

    // public function edit(Item $item)
    // {
    //     $loginUser = auth()->user();
    //     $users = User::all();

    //     return view('todo.edit', compact('item', 'loginUser', 'users'));
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Item $item)
    // {
    //     $now = Carbon::now();
    //     $date = $now->format('Y-m-d');

    //     $item->user_id = $request->user_id;
    //     $item->item_name = $request->item_name;
    //     $item->registration_date = $date;
    //     $item->expire_date = $request->expire_date;
    //     if (isset($request->finished_date)) {
    //         $item->finished_date = $date;
    //     } else {
    //         $item->finished_date = null;
    //     }

    //     $item->save();

    //     return redirect('./todo');
    // }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        $now = Carbon::now();
        $date = $now->format('Y-m-d');

        $item->user_id = $request->user_id;
        $item->item_name = $request->item_name;
        $item->expire_date = $request->expire_date;
        if (isset($request->finished_date)) {
            $item->finished_date = $date;
        } else {
            $item->finished_date = null;
        }

        $item->save();

        return redirect('./todo');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Item $item)
    // {
    //     $item->delete();
    //     return redirect('./todo');
    // }

    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect('./todo');
    }

}