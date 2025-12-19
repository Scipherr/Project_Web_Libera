<x-app-layout>
    {{-- Page Header --}}
    <div class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">
                {{ __('Latest Posts') }}
            </h1>
            <p class="mt-2 text-gray-600">
                Discover stories, thinking, and expertise from writers on any topic.
            </p>
        </div>
    </div>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Category Filter Section --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-100 pb-4 mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Filter by Category</h2>
                    </div>
                    <x-category-tabs/>
                </div>
            </div>

            {{-- Posts Feed --}}
            <div>
                @forelse ($posts as $post)
                    {{-- Wrapper for hover effects (optional, as post-item handles its own basic style) --}}
                    <div class="transition-transform duration-300 hover:-translate-y-1">
                        <x-post-item :post="$post"></x-post-item>
                    </div>
                @empty
                    {{-- Styled Empty State --}}
                    <div class="flex flex-col items-center justify-center py-16 bg-white rounded-lg shadow-sm border border-gray-100 text-center">
                        <div class="bg-gray-50 p-4 rounded-full mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900">No posts found</h3>
                        <p class="text-gray-500 max-w-sm mt-2">
                            We couldn't find any posts matching your criteria. Try selecting a different category or check back later.
                        </p>
                        <a href="{{ route('dashboard') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Clear Filters
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-10 flex justify-center">
                <div class="bg-white px-4 py-3 rounded-lg shadow-sm border border-gray-100">
                    {{ $posts->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>