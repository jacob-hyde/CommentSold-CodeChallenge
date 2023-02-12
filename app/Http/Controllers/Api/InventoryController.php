<?php

namespace App\Http\Controllers\Api;

use App\Actions\ListInventoryAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\InventoryResource;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invetory = ListInventoryAction::run($request);
        return InventoryResource::collection($invetory)
            ->response()
            ->setStatusCode(200);
    }

}
