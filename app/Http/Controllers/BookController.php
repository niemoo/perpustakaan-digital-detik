<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('id', 'desc')
            ->with('category')
            ->when(auth()->user()->role !== 'admin', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->when(request()->has('category_id'), function ($query) {
                $query->where('category_id', request()->category_id);
            })
            ->paginate(10);
            
        return view('dashboard.book.index', ['books' => $books]);
    }

    public function dashboard()
    {
        $books = Book::with('category')->get();
        return view('dashboard.dashboard', ['books' => $books]);
    }

    public function create()
    {
        return view('dashboard.book.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(StoreBookRequest $request)
    {  
        $cover = $request->file('cover');
        $cover->storeAs('public/images', $cover->hashName());
        
        $file = $request->file('file');
        $file->storeAs('public/files', $file->hashName());
        
        Book::create([
            'user_id' => auth()->user()->id,
            'category_id' => $request->validated('category_id'),
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'amount' => $request->validated('amount'),
            'file' => $file->hashName(),
            'cover' => $cover->hashName()
        ]);
    
        Alert::success('Success', 'Berhasil menambah data buku');
        return redirect()->route('book.index');
    }

    public function show(Book $book)
    {
        return view('dashboard.book.showPdf', [
            'book' => $book,
        ]);
    }
    
    public function edit(Book $book)
    {
        return view('dashboard.book.edit', [
            'book' => $book,
            'categories' => Category::all(),
        ]);
    }

    public function update(UpdateBookRequest $request, $id)
    {
        try {
            $book = Book::find($id);

            if ($request->hasFile('cover')) {
                // if ($request->oldImage) {
                //     Storage::disk('public/images')->delete($request->oldImage);
                // }

                $cover = $request->file('cover');
                $cover->storeAs('public/images', $cover->hashName());
            }

            if ($request->hasFile('file')) {
                // if ($request->oldFile) {
                //     Storage::disk('public/files')->delete($request->oldFile);
                // }

                $file = $request->file('file');
                $file->storeAs('public/files', $file->hashName());
            }

            $book->update([
                'title' => $request->input('title', $book->title),
                'category_id' => $request->input('category_id', $book->category_id),
                'cover' => $request->hasFile('cover') ? $cover : $book->cover,
                'file' => $request->hasFile('file') ? $file : $book->file,
                'amount' => $request->input('amount', $book->amount),
                'description' => $request->input('description', $book->description),
            ]);

            Alert::success('Success', 'Book updated successfully');
            return redirect()->route('book.index');
        } catch (\Throwable $err) {
            Alert::error('Error', 'Book failed to update');
            return redirect()->route('book.index');
        }
    }

    public function destroy(Book $book)
    {
        try {
            // Storage::disk('public')->delete($book->image);
            // Storage::disk('public')->delete($book->pdf);
            $book->delete();
            Alert::success('Success', 'Book deleted successfully');
            return redirect()->route('book.index');
        } catch (\Throwable $err) {
            Alert::error('Error', 'Book failed to delete');
            return redirect()->route('book.index');
        }
    }
}
