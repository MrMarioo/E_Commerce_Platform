<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\QueryBuilder\QueryBuilder;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $brand = QueryBuilder::for(subject: Brand::class)
            ->allowedFilters(filters: ['id', 'name', 'slug'])
            ->allowedSorts(sorts: ['id', 'name', 'slug', 'created_at'])
            ->defaultSort(sorts: ['name'])
            ->paginate(perPage: $request->input('per_page', 10), page: $request->input('page', 1) + 1);

        return Inertia::render('Brands/Index', [
            'brands' => BrandResource::collection(resource: $brand),
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
