<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * List all items.
     */
    public function index(Request $request)
    {
        $query = Item::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('filter')) {
            $filterBy = $request->has('filter_by') ? $request->filter_by : 'name';

            $query->where($filterBy, 'like', "%{$request->filter}%");
        }

        return response()->json($query->get());
    }

    /**
     * Show an item.
     */
    public function show(Item $item)
    {
        return response()->json($item);
    }

    /**
     * Create a new item.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'code' => 'required|numeric',
            'status' => 'required|in:Active,Inactive',
        ]);

        $item = Item::create([
            'uuid' => (string) \Str::uuid(),
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description ?? null,
            'status' => $request->status,
        ]);

        return response()->json($item, 201);
    }

    /**
     * Update an item.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string',
            'code' => 'required|numeric',
            'status' => 'required|in:Active,Inactive',
        ]);

        $item->update([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description ?? null,
            'status' => $request->status,
        ]);

        return response()->json($item);
    }
}
