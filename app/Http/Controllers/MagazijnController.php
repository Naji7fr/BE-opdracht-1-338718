<?php

namespace App\Http\Controllers;

use App\Models\MagazijnModel;
use Illuminate\Http\Request;

class MagazijnController extends Controller
{
    private $magazijnModel;

    public function __construct()
    {
        $this->magazijnModel = new MagazijnModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = MagazijnModel::getAllProducts();

        return view('magazijn.index', [
            'title' => 'Overzicht Magazijn Jamin',
            'products' => $products
        ]);
    }

    public function allergenenInfo($id)
    {
        // Get product and allergen data
        $product = MagazijnModel::getProductById($id);
        $allergens = MagazijnModel::getAllergensByProductId($id);
        
        return view('magazijn.allergeenInfo', [
            'product' => $product,
            'allergens' => $allergens
        ]);
    }

    public function leverantieInfo($id)
    {
        // Get product data
        $product = MagazijnModel::getProductById($id);
        
        // Check if product has stock (for Winegums scenario)
        $hasStock = MagazijnModel::hasStock($id);
        
        if ($hasStock) {
            // Scenario 1: Show delivery data (Mintnopjes)
            $deliveries = MagazijnModel::getDeliveriesByProductId($id);
            $supplier = MagazijnModel::getSupplierByProductId($id);
        } else {
            // Scenario 2: No stock (Winegums) - empty arrays
            $deliveries = collect();
            $supplier = null;
        }
        
        return view('magazijn.leverantieInfo', [
            'product' => $product,
            'deliveries' => $deliveries,
            'supplier' => $supplier,
            'hasStock' => $hasStock
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MagazijnModel $magazijnModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MagazijnModel $magazijnModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MagazijnModel $magazijnModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MagazijnModel $magazijnModel)
    {
        //
    }
}
