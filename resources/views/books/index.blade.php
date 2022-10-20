<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-20 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center pb-4 bg-white dark:bg-gray-900">
                        @can('create', \App\Models\Book::class)
                            <div class="flex">
                                <a href="{{route('books.create') }}" class="py-2 px-4 text-sm font-medium text-white bg-gray-800 rounded-l rounded-r  hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Add new book</a>
                            </div>
                        @endcan
                        
                        <div class="w-64">
                            <select id="categorie_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" id="table-search-tasks" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search books">
                        </div>
                    </div>
                    <div class="mx-auto container py-4">
                        <div class="flex flex-wrap lg:justify-between justify-center">
                            @if (count($books) > 0)
                                @foreach ($books as $book)
                                    <div tabindex="0" class="focus:outline-none mx-2 w-72 xl:mb-0 mb-8">
                                        <div>
                                            <img alt="person capturing an image" src="https://cdn.tuk.dev/assets/templates/classified/Bitmap (1).png" tabindex="0" class="focus:outline-none w-full h-44" />
                                        </div>
                                        <div class="bg-white">
                                            <div class="flex items-center justify-between px-1 pt-4">
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" tabindex="0" class="focus:outline-none" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M9 4h6a2 2 0 0 1 2 2v14l-5-3l-5 3v-14a2 2 0 0 1 2 -2"></path>
                                                    </svg>
                                                </div>
                                                <div class="bg-yellow-200 py-1.5 px-6 rounded-full">
                                                    <p tabindex="0" class="focus:outline-none text-xs text-yellow-700">{{ $book->category->name }}</p>
                                                </div>
                                            </div>
                                            <div class="p-2 mt-3">
                                                <div class="flex-col">
                                                    <h2 tabindex="0" class="focus:outline-none text-lg font-bold">{{ $book->title }}</h2>
                                                    <p tabindex="0" class="focus:outline-none text-xs text-gray-600 mt-3">• Publié le {{ $book->created_at->format('j M Y') }}</p>
                                                </div>
                                                <p tabindex="0" class="focus:outline-none text-xs text-gray-600 mt-3">{{ $book->description }}</p>
                                                <div class="flex items-center justify-between mt-4">
                                                    <div>
                                                        <a tabindex="0" href="{{ Storage::url($book->book_path) }}" class="py-2 px-9 text-sm font-medium text-white bg-gray-800 rounded-l rounded-r  hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Lire</a>
                                                    </div>
                                                    <div class="flex items-center gap-y-2">
                                                        @can('update', $book)
                                                            <div class="mr-3">
                                                                <a tabindex="0" href="{{ route('books.edit', $book) }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        @endcan

                                                        @can('delete', $book)
                                                            <div class="mt-2">
                                                                <form action="{{ route('books.destroy', $book) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit">
                                                                        <a tabindex="0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-red-500">
                                                                                <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                                                                            </svg>
                                                                        </a>
                                                                    </button> 
                                                                </form>     
                                                            </div>
                                                        @endcan
                                                    </div>
                                                </div>
                                                <div class="flex items-center justify-between py-4">
                                                    <h2 tabindex="0" class="focus:outline-none text-indigo-700 text-xs font-semibold">By {{ $book->author->name }}</h2>
                                                    <h3 tabindex="0" class="focus:outline-none text-indigo-700 text-xl font-semibold"></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>Not books yet</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>