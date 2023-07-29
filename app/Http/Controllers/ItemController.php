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
        $items = Item::all();
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
    public function edit(Item $todo)
    {
        $item = Item::find($todo->id);
        $user = auth()->user();

        return view('todo.edit', compact('item', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}