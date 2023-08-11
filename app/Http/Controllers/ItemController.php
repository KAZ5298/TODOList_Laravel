<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $item;
    public function __construct()
    {
        $this->item = new Item();
    }

    public function index(Request $request)
    {
        $date = getDate();

        $loginUser = auth()->user();

        // 通常の一覧表示か、検索結果か
        $search = $request->input('search');
        if (empty($search)) {
            $items = $this->item->getAllItemOrderByExpireDate();
        } else {
            $items = $this->item->getSearchItem($search);
        }

        return view('item.index', compact('date', 'items', 'loginUser', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $item = new Item;
        $date = $item->getDate();

        $users = User::all();
        $loginUser = auth()->user();
        return view('item.create', compact('date', 'users', 'loginUser'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $item = new Item;
        $date = $item->getDate();

        $item = $item->fill($request->all());
        $item->registration_date = $date;
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
        $date = $item->getDate();

        $item = $item->fill($request->all());
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
        $date = $item->getDate();

        $item->finished_date = $date;

        $item->save();

        return redirect()->route('item.index');
    }
}