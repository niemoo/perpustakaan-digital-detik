@extends('dashboard.layouts.dashboardmain')
@section('title', 'Create Book')
@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 rounded-lg mt-14">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 flex-0">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 m-auto flex-0 lg:w-8/12">
                        <div class="mt-4">
                            <a href="{{ route('book.index') }}" class="inline-block px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-teal-500 border border-transparent rounded-lg active:bg-yellow-300 hover:bg-yellow-400 focus:outline-none focus:shadow-outline-yellow hover:text-white ni ni-bold-left">
                                Kembali ke Halaman Sebelumnya    
                            </a>
                        </div>
                        <div
                            class="p-3 mt-3 bg-white border border-blue-500 rounded-lg dark:bg-slate-850 dark:border-slate-800">
                            <iframe src="{{ asset($book->file) }}"
                                class="w-full rounded-lg h-screen" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
