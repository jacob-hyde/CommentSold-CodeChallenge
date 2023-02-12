<?php

namespace App\Actions;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class ListInventoryAction
{
    use AsAction;

    public function handle(Request $request)
    {
        $user = auth()->user();
        $inventoryQuery = Inventory::leftJoin('products', 'products.id', '=', 'inventory.product_id')
            ->select('inventory.*', 'products.product_name')
            ->orderBy($request->get('sort_by', 'id'), $request->get('sort_order', 'asc'));

        if (!$user->superadmin) {
            $inventoryQuery->where('products.admin_id', $user->id);
        }

        if ($request->has('search')) {
            $inventoryQuery->where('products.product_name', 'like', "%{$request->search}%")
                ->orWhere('products.id', 'like', "%{$request->search}%")
                ->orWhere('inventory.sku', 'like', "%{$request->search}%");
        }

        return $inventoryQuery->paginate($request->per_page ?? 10);
    }
}
