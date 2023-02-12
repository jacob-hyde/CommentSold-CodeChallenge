<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view a product.
     *
     * @param User     $user    The user that is trying to view the product
     * @param Product  $product The product that is being viewed
     *
     * @return Response Respond allow or deny access to view the product
     */
    public function view(User $user, Product $product)
    {
        return ($user->id === $product->admin_id || $user->superadmin) ? Response::allow() : Response::deny('You do not have permission to view this product.');
    }

    /**
     * Determine whether the user can update a product.
     *
     * @param User    $user    The user that is trying to update the product
     * @param Product $product The product that is being updated
     *
     * @return Response Respond allow or deny access to update the product
     */
    public function update(User $user, Product $product)
    {
        return ($user->id === $product->admin_id || $user->superadmin) ? Response::allow() : Response::deny('You do not have permission to update this product.');
    }

}
