<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DanhmucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = Category::all();
        return view('admin.qldanhmuc.index', compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.qldanhmuc.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'unique:category',
            'slug' => 'unique:category',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/category');
        }

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $imagePath ? str_replace('public/', 'storage/', $imagePath) : null,
            'status' => $request->status, 
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.qldanhmuc.index')->with('success');
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
        $category = Category::findOrFail($id);
        $categories = Category::whereNull('parent_id')
                              ->where('id', '!=', $id) // Id không phải danh mục hiện tại
                              ->get();
    
        return view('admin.qldanhmuc.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                function ($attribute, $value, $fail) use ($id) {
                    if (Category::where('name', $value)->where('id', '!=', $id)->exists()) {
                        $fail('đã tồn tại.');
                    }
                }
            ]
        ]);

        $category = Category::findOrFail($id);       
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $request->image,
            'parent_id' => $request->parent_id,
            'status' => $request->status == 'Hiện' ? 1 : 0, 
        ]);

        return redirect()->route('admin.qldanhmuc.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id); 
        $category->delete(); 

        return redirect()->route('admin.qldanhmuc.index');
    }
}
