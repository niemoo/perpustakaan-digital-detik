<?php

namespace App\Http\Controllers;

use App\Exports\BookExport;
use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
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

    public function export()
    {
        return Excel::download(new BookExport, 'book.xlsx');
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
        $filenameCover = date('Y-m-d').$cover->getClientOriginalName();
        $pathCover = 'images/'.$filenameCover;
        Storage::disk('public')->put($pathCover, file_get_contents($cover));
        // $cover->storeAs('public/images', $cover->hashName());
        
        $file_pdf = $request->file('file');
        $filenameFile_pdf = date('Y-m-d').$file_pdf->getClientOriginalName();
        $pathFile = 'files/'.$filenameFile_pdf;
        Storage::disk('public')->put($pathFile, file_get_contents($file_pdf));
        // $file->storeAs('public/files', $file->hashName());
        
        Book::create([
            'user_id' => auth()->user()->id,
            'category_id' => $request->validated('category_id'),
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'amount' => $request->validated('amount'),
            'file' => $filenameFile_pdf,
            'cover' => $filenameCover
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

    public function update(Request $request, $id)
    {
        try {
            $book = Book::find($id);

            $validator = Validator::make($request->all(), [
                'category_id' => 'nullable|integer',
                'title' => 'nullable|string',
                'description' => 'nullable|string',
                'amount' => 'nullable|numeric|min:0',
                'file' => 'nullable|file|mimes:pdf',
                'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

            $data = [
                'title' => $request->title,
                'category_id' => $request->category_id,
                'amount' => $request->amount,
                'description' => $request->description
            ];

            $cover = $request->file('cover');
            
            if ($cover) {
                $filenameCover = date('Y-m-d').$cover->getClientOriginalName();
                $pathCover = 'images/'.$filenameCover;
                Storage::disk('public')->put($pathCover, file_get_contents($cover));
                $data['cover'] = $filenameCover;
            }
            
            $file_pdf = $request->file('file_pdf');

            if ($file_pdf) {
                $filenameFile_pdf = date('Y-m-d').$file_pdf->getClientOriginalName();
                $pathFile = 'files/'.$filenameFile_pdf;
                Storage::disk('public')->put($pathFile, file_get_contents($file_pdf));
                $data['file'] = $filenameFile_pdf;
            }

            $book->update($data);

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
