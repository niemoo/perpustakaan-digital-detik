@extends('dashboard.layouts.dashboardmain')
@section('title', 'Create Book')
@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 rounded-lg mt-14">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 m-auto flex-0 lg:w-8/12">
                        <div class="my-4">
                            <a href="{{ route('book.index') }}" class="inline-block px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-teal-500 border border-transparent rounded-lg active:bg-yellow-300 hover:bg-yellow-400 focus:outline-none focus:shadow-outline-yellow hover:text-white ni ni-bold-left">
                                Kembali ke Halaman Sebelumnya
                            </a>
                        </div>
                        <form class="relative mb-32" style="height: 402px;" action="{{route('book.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div
                                class="absolute top-0 left-0 flex flex-col visible w-full h-auto min-w-0 p-4 break-words bg-white border border-gray-300 shadow-xl opacity-100 dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                                <h5 class="mb-0 font-bold dark:text-white">Tambah Buku</h5>
                                <div>
                                    <div class="flex flex-wrap mt-4 -mx-3">
                                        <div class="w-full max-w-full px-3 flex-0 sm:w-6/12">
                                            <label class="mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80"
                                                for="title">Judul</label>
                                            <input type="text" name="title" placeholder="Contoh: Cara Menuntut Ilmu"
                                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" required>
                                        </div>
                                        <div class="w-full max-w-full px-3 mt-4 flex-0 sm:mt-0 sm:w-6/12">

                                            <label for="categories"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                                            <select id="categories" name="category_id"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                @foreach ($categories as $category)
                                                @if (old('category_id') == $category->id)
                                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="flex flex-wrap mt-4 -mx-3">
                                        <div class="w-full max-w-full px-3 flex-0 sm:w-6/12">
                                            <label class="mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80"
                                                for="cover">Gambar</label>
                                            <input name="cover"
                                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                id="cover" type="file" accept=".jpg, .jpeg, .png" required>
                                        </div>
                                        <div class="w-full max-w-full px-3 mt-4 flex-0 sm:mt-0 sm:w-6/12">
                                            <label class="mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80"
                                                for="file">File Buku</label>
                                            <input name="file"
                                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                id="file" type="file" accept=".pdf" required>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap mt-4 -mx-3">
                                        <div class="w-full max-w-full px-3 flex-0 sm:w-6/12">

                                            <form class="max-w-xs mx-auto">
                                                <label for="quantity-input"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Buku:</label>
                                                <div class="relative flex items-center max-w-[8rem]">
                                                    <input type="number" name="amount" id="quantity-input" data-input-counter
                                                        aria-describedby="helper-text-explanation"
                                                        class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="999" required>
                                                </div>
                                            </form>

                                        </div>
                                        <div class="w-full max-w-full px-3 mt-4 flex-0 sm:mt-0 sm:w-6/12">
                                            <label class="mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80"
                                                for="description">Description</label>
                                            <textarea id="description" rows="4" name="description"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Tuliskan deskripsinya" required></textarea>
                                        </div>
                                    </div>
                                    <div class="flex mt-6">
                                        <button type="submit"
                                            class="inline-block px-6 py-3 mb-0 ml-auto text-xs font-bold text-right text-white uppercase align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 bg-gradient-to-tl from-zinc-800 to-zinc-700 leading-pro tracking-tight-rem bg-150 bg-x-25">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const decrementButton = document.getElementById('decrement-button');
            const incrementButton = document.getElementById('increment-button');
            const quantityInput = document.getElementById('quantity-input');
        
            let quantity = parseInt(quantityInput.value, 10) || 0;
        
            function updateQuantity(newQuantity) {
                quantity = newQuantity;
                quantityInput.value = quantity;
            }
        
            decrementButton.addEventListener('click', () => {
                if (quantity > 0) {
                    updateQuantity(quantity - 1);
                }
            });
        
            incrementButton.addEventListener('click', () => {
                updateQuantity(quantity + 1);
            });
        
            quantityInput.addEventListener('input', (event) => {
                let value = parseInt(event.target.value, 10);
                if (isNaN(value) || value < 0) {
                    value = 0;
                }
                updateQuantity(value);
            });
        });
        </script>
        
@endsection