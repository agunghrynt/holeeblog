<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Livewire\SlugGenerator;
use Illuminate\Support\Facades\Gate;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('mustadmin');
        return view('user-dashboard.categories.index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('mustadmin');
        $makeData = 'cat';
        return view('/user-dashboard/categories/create', [
            'categories' => Category::all(),
            'makeData' => $makeData,
            'data' => SlugGenerator::class,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('mustadmin');
        $validatedData = $request->validate([
            'name' => ['required', 'max:55', 'unique:categories'],
            'slug' => ['required', 'unique:categories']
        ]);

        Category::create($validatedData);

        return redirect('/user-dashboard/categories')->with('success', $request->name . ' has been added to category');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        Gate::authorize('mustadmin');
        return view('/user-dashboard/categories/edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        Gate::authorize('mustadmin');
        $rules = [
            'name' => ['required', 'max:55'],
            'slug' => ['required', 'unique:categories']
        ];

        if($request->name != $category->name && $request->slug != $category->slug) {
            $rules['name'] = ['required', 'max:55'];
            $rules['slug'] = ['required', 'unique:categories'];
        }

        $validatedData = $request->validate($rules);

        Category::where('id', $category->id)
            ->update($validatedData);

        return redirect('/user-dashboard/categories')->with('success', $category->name . ' has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        Gate::authorize('mustadmin');
        Category::destroy($category->id);
        return redirect('/user-dashboard/categories')->with('success', $category->name . ' category has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
