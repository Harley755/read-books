<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <!-- TITLE -->
                        <div>
                            <x-input-label for="Title" :value="__('Title')" />
                            
                            <x-text-input id="title" class="block mt-1 w-full" type="text" 
                                name="title" 
                                placeholder="{{ __('Enter title') }}"
                                :value="old('title', $book->title)" 
                                required autofocus
                            />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        
                        <!-- DESCRIPTION -->
                        <div class="mt-5">
                            <x-input-label for="Description" :value="__('Description')" />
                            <textarea
                                name="description"
                                placeholder="{{ __('Enter description') }}"
                                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            >{{ old('description', $book->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        
                        <!-- NBRE_PAGE -->
                        <div class="mt-5">
                            <x-input-label for="Nombre de page" :value="__('Nombre de page')" />
                            <x-text-input id="nbre_pages" class="block mt-1 w-full" type="number"
                            placeholder="{{ __('Enter number\'s pages') }}"
                            name="nbre_pages" 
                            :value="old('nbre_pages', $book->nbre_pages)" required
                            />
                            <x-input-error :messages="$errors->get('nbre_pages')" class="mt-2" />
                        </div>
                        
                        <!-- CATEGORIE -->
                        <div class="mt-4"> 
                            <label for="categorie_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select category id</label>
                            <select id="categorie_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                
                                    <option value="{{ $book->category->id }}">{{ $book->category->name }}</option>

                            </select>
                        </div>
                        
                        <!-- AUTHOR -->
                        <div class="mt-4"> 
                            <label for="categorie_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select category id</label>
                            <select id="categorie_id" name="author_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                               
                                    <option value="{{ $book->author->id }}">{{ $book->author->name }}</option>
                               
                            </select>
                        </div>
                        
                        <!-- BOOK_PATH -->
                        <div class="mt-4">
                            <x-input-label for="Book_path" :value="__('Book_path')" />
                            <x-text-input id="book_path" class="block mt-1 w-full" type="file" 
                                name="book_path" 
                                :value="old('book_path',$book->book_path)" required
                            />
                            <x-input-error :messages="$errors->get('book_path')" class="mt-2" />
                        </div>

                        <div class="mt-9 space-x-2">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            <a href="{{ route('books.index') }}">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
