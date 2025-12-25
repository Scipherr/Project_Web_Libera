<x-app-layout>
  <div class="py-12 bg-gray-50">
    
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(request()->page <= 1 && !request('category'))
             <div class="bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg">
                        Latest Posts
            </div>
                <x-latest-posts-carousel :posts="$carouselPosts" />
            @endif

            </div>
    </div>

    <div class="py-12 bg-gray-50">
        News feed
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <x-category-tabs/>
                </div>
            </div>

            <div class="mt-8 text-gray-900">
                
                    @forelse ($posts as $post)

                    <x-post-item :post="$post"></x-post-item>

                    @empty
                    <div class="text-center">NO POST FOUND</div>
                    @endforelse
                
            </div>
            {{ $posts->onEachSide(1)->links() }}
        </div>
    </div>
    </div>
</x-app-layout>