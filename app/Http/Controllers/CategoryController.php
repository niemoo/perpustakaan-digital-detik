<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index()
    {
        // $categories = Category::get();
        // return view('dashboard', ['categories' => $categories]);
        return view('dashboard.category.index', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()) {
            Alert::error('Error', 'Book failed to delete');
            return redirect()->route('category.index');;
        }


        Category::create([
            'name' => $request->name
        ]);

        Alert::success('Success', 'Berhasil menambah kategori');
        return redirect()->route('category.index');
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $category->update([
            'name' => $request->input('name'),
        ]);

        Alert::success('Success', 'Category updated successfully');
        return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            Alert::success('Success', 'Category deleted successfully');
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Category failed to delete');
            return redirect()->route('category.index');
        }
    }
}
