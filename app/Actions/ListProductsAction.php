<?php

namespace App\Actions;

use App\Models\Product;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class ListProductsAction
{
    use AsAction;

    public function handle(Request $request)
    {
        $user = auth()->user();
        $productsQuery = Product::with(['inventory'])
            ->orderBy($request->get('sort_by', 'id'), $request->get('sort_order', 'asc'));
        if (!$user->superadmin) {
            $productsQuery->where('admin_id', $user->id);
        }
        return $productsQuery->paginate($request->per_page ?? 100);
    }
}
