@extends('dashboard.layouts.dashboardmain')
@section('title', 'book')
@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 rounded-lg mt-14">
    <div class="flex flex-wrap -mx-3 overflow-hidden">
        <div class="flex-none w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border border-gray-300 border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <h5 class="font-semibold text-lg p-6">Tabel Buku</h5>
                <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid md:px-6 md:flex grid gap-5 justify-between">
                    <form action="{{ route('book.index') }}" method="get" class="md:flex grid gap-5 items-center space-x-4">
                        <div class="md:w-8/12 w-full md:pl-0 pl-5">
                            <select name="category_id" id="category_id"
                                class="block w-full mt-1 border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="" disabled {{ request('category_id') ? '' : 'selected' }}>-- Select Category --</option>
                                @foreach (\App\Models\Category::all() as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request('category_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-end w-2/12 space-x-2">
                            <button type="submit"
                                class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                                Filter
                            </button>
                            <a href="{{ route('book.index') }}"
                                class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:shadow-outline-gray active:bg-gray-400">
                                Reset
                            </a>
                        </div>
                    </form>
                    
                    <div class="flex items-center space-x-4">
                        <a href="{{route('book.export')}}" type="button" data-tooltip-target="tooltip-exportbook"
                            class="px-4 py-2 m-2 mb-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Export Buku
                        </a>
                        <a href="{{ route('book.create') }}" type="button" data-tooltip-target="tooltip-addbook"
                            class="px-4 py-2 m-2 mb-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Tambah buku
                        </a>
                    </div>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table
                            class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        No
                                    </th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Judul</th>
                                    <th
                                        class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Cover</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Kategori</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Jumlah Buku</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Deskripsi</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        File PDF</th>
                                    <th
                                        class="px-6 py-3 font-semibold uppercase align-middle bg-transparent border-b border-collapse border-solid shadow-none dark:border-white/40 dark:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($books as $book)
                                    <tr>
                                        <td
                                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $loop->iteration }}</span>
                                        </td>
                                        <td
                                            class="p-2 text-sm text-left bg-transparent border-b align-center dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <div class="flex items-center justify-center">
                                                <h6 class="mb-0 text-sm leading-normal dark:text-white">
                                                    {{ $book->title }}</h6>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 text-sm text-left bg-transparent border-b align-center dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <div class="flex items-center justify-center">
                                                <img src="{{ asset($book->cover) }}" class="w-44 rounded-lg">
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 text-sm text-left bg-transparent border-b align-center dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <div class="flex items-center justify-center">
                                                <h6 class="mb-0 text-sm leading-normal dark:text-white">
                                                    {{ $book->category->name }}</h6>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 text-sm text-left bg-transparent border-b align-center dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <div class="flex items-center justify-center">
                                                <h6 class="mb-0 text-sm leading-normal dark:text-white">
                                                    {{ $book->amount }}</h6>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 text-sm text-left bg-transparent border-b align-center dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <div class="flex items-center justify-center">
                                                <h6 class="mb-0 text-sm leading-normal dark:text-white">
                                                    {{ $book->description }}</h6>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 shadow-transparent">
                                            <span class="flex items-center justify-center">
                                                <a href="{{ route('book.show', $book->id) }}"
                                                    data-tooltip-target="tooltip-book{{ $book->id }}"
                                                    class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                    type="button">Lihat PDF</a>
                                            </span>
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <div class="flex items-center justify-center">
                                                <a href="{{ route('book.edit', $book->id) }}" type="button"
                                                    data-tooltip-target="tooltip-edit{{ $book->id }}"
                                                    class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-1.5 text-center m-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-400 dark:focus:ring-yellow-800">Edit</a>
                                                <form action="{{ route('book.destroy', $book->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" data-tooltip-target="tooltip-delete{{ $book->id }}"
                                                        class="text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-1.5 text-center m-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                                        data-confirm-delete="true">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection