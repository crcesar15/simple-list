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
            $filterBy = $request->has('filter') ? $request->filter : 'name';

            $query->where($filterBy, 'like', "%{$request->name}%");
        }

        return response()->json($query->get());
    }
}
