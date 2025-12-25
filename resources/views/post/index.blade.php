<x-app-layout>
    <div class="min-h-screen bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-slate-900 via-purple-900 to-black text-gray-100">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10 py-12">
            
            @if(request()->page <= 1 && !request('category'))
                <div class="space-y-4">
                    <h2 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-pink-400 inline-block">
                        Latest Posts
                    </h2>
                    <x-latest-posts-carousel :posts="$carouselPosts" />
                </div>
            @endif

            <div class="space-y-6">
                <h2 class="text-2xl font-bold tracking-wide text-gray-200 border-l-4 border-pink-500 pl-4">
                    News Feed
                </h2>

                <div class="bg-white/5 backdrop-blur-md border border-white/10 p-4 rounded-xl shadow-2xl">
                    <x-category-tabs/>
                </div>

                <div class="mt-8">
                    @forelse ($posts as $post)
                        <x-post-item :post="$post"></x-post-item>
                    @empty
                        <div class="p-12 text-center bg-white/5 rounded-xl border border-dashed border-gray-600">
                            <p class="text-gray-400 text-lg">No signals detected in this sector.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $posts->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>