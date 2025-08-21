<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Response;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $products = QueryBuilder::for(subject: Product::class)
            ->allowedFilters(filters: ['name', 'price', 'status'])
            ->allowedSorts(sorts: ['name', 'price', 'status', 'created_at'])
            ->defaultSort(sorts: ['name'])
            ->paginate(perPage: $request->input(key:'per_page', default: 10), page: $request->input(key:'page', default: 1) + 1);

        return inertia(component: 'Products/Index', props: [
            'products' => [ProductResource::collection(resource: $products)]
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
