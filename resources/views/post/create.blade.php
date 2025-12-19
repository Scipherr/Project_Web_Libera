<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('post.store') }}"  enctype="multipart/form-data" method="post">
                    
                 
                   @csrf
                    
                    <!---input image--->
                    <div>
                         <x-input-label for="image" :value="__('Image')" />
                        <x-text-input id="image" class="block mt-1 w-full" type="file" name="image"
                            :value="old('image')" required  />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />


                    </div>


                    <!---Category--->
                    <div class="mt-8">
                        
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select id="category_id" name ="category_id" class='border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-4 w-full'>
                            <option value="">Select A Category</option>
                            @foreach ($categories as $category)
                            <option value ="{{ $category->id }}" @selected(old('category_id')==$category->id)>
                                
                                {{ $category->name }}

                            </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>
                    
                    <!---TITLE--->
                    <div class="mt-8">
                        
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            :value="old('title')" required/>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
              
                            <!---Content--->
                      
                    <div class="mt-8">
                        <x-input-label for="content" :value="__('Content')" />
                        <x-input-textarea id="content" class="block mt-1 w-full" type="text" name="content"
                         required >{{ old('content') }}</x-input-textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <x-primary-button class="mt-9">
                        SUBMIT
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(editor => {
                editor.ui.view.editable.element.style.minHeight = '300px'; // Set a minimum height
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</x-app-layout>