<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalog;

class CatalogsController extends Controller
{
    public function getCatalogsByType($type)
    {
        $catalogs = Catalog::where('type', $type)->get();
        return response()->json($catalogs);
    }
}
