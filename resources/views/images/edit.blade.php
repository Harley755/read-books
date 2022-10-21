<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New image') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('images.update', $image) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        
                        <!-- IMAGE_PATH -->
                        <div class="mt-4">
                            <x-input-label for="Image_path" :value="__('Image_path')" />
                            <x-text-input id="image_path" class="block mt-1 w-full" type="file" 
                                name="image_path" 
                                :value="old('image_path', $image->image_path)" required
                            />
                            <x-input-error :messages="$errors->get('image_path')" class="mt-2" />
                            Before
                            <img src="{{ Storage::url($image->image_path) }}" alt="">
                        </div>

                        <div class="flex flex-col mt-9">
                            <div class="flex">
                                <div>
                                    <x-input-label for="Image for" :value="__('Image for')" />
                                    <div class="form-check">
                                        <input type="radio" id="authors" name="same_name" value="author" class="appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" checked>
                                        <label class="form-check-label inline-block text-gray-800" for="authors">
                                            Author
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="books" name="same_name" value="book" class="appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer">
                                        <label class="form-check-label inline-block text-gray-800" for="books">
                                            Book
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex mt-9">
                                <div>
                                    <label for="categorie_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select author</label>
                                    <select id="categorie_id" name="author_id" class="w-64 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @foreach ($authors as $author)
                                            <option value="{{ $image->imageable_id }}">{{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="ml-9"> 
                                    <label for="categorie_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select book</label>
                                    <select id="categorie_id" name="book_id" class="w-64 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @foreach ($books as $book)
                                            <option value="{{ $image->imageable_id }}">{{ $book->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-9 space-x-2">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            <a href="{{ route('images.index') }}">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
