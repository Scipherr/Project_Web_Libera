<x-app-layout>
    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex items-center justify-between px-2">
                        <h2 class="text-xl font-bold text-gray-800">Recent Posts</h2>
                    </div>

                    <div class="space-y-6">
                        <!--POST----------------------------------------------------------------------------------->
                        @forelse ($posts as $post)
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 transition hover:shadow-md">
                            <x-post-item :post="$post"></x-post-item>


    {{-- OWNER ACTIONS --}}
    @if(Auth::check() && Auth::id() === $user->id)
        <div class="mt-4 pt-4 border-t border-gray-100 flex gap-3 justify-end">
            {{-- Edit Button --}}
            <a href="{{ route('post.edit', $post->id) }}" 
            class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
            Edit
            </a>

            {{-- Delete Button --}}
            <form action="{{ route('post.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition">
                    Delete
                </button>
            </form>
        </div>
    @endif  </div> 
    @empty
                        <div class="bg-white p-12 rounded-2xl border border-dashed border-gray-300 text-center">
                            <div class="text-gray-400 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">No posts yet</h3>
                            <p class="text-gray-500 text-sm">When {{ $user->name }} posts something, it will show up
                                here.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                <!--USER----------------------------------------------------------------------------------->
                <div class="lg:col-span-1">
                    <div class="sticky top-6">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                            <div class="h-32 bg-gradient-to-r from-blue-100 to-indigo-100"></div>

                           <x-follow-ctr :user="$user">

                                <div class="-mt-12 mb-4">
                                    <div class="inline-block p-1 bg-white rounded-full ring-2 ring-gray-50">
                                        <x-user-pfp :user="$user" class="w-24 h-24 rounded-full object-cover" />
                                    </div>
                                </div>

                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                                    <p class="text-sm text-gray-500 font-medium">@ {{ Str::slug($user->username) }}</p>
                                    <p class="mt-4 text-gray-600 leading-relaxed text-sm">
                                        {{ $user->bio ?? 'No bio available.' }}
                                    </p>
                                </div>

                                <div class="flex gap-6 mt-6 border-t border-b border-gray-50 py-4">
                                    <div class="text-center">
                                        <span class="block font-bold text-lg text-gray-900">{{ $posts->count() }}</span>
                                        <span class="text-xs text-gray-500 uppercase tracking-wide">Posts</span>
                                    </div>
                                    <div class="text-center">
                                        <span class="block font-bold text-lg text-gray-900"
                                            x-text="followersCount"></span>
                                        <span class="text-xs text-gray-500 uppercase tracking-wide">Follower</span>
                                    </div>
                                    <div class="text-center">
                                        <span class="block font-bold text-lg text-gray-900">24</span>
                                        <span class="text-xs text-gray-500 uppercase tracking-wide">Following</span>
                                    </div>
                                </div>

                                @if (auth()->user() && auth()->user()->id !== $user->id)
                                <div class="mt-6">
                                    <button @click="follow()"
                                        class="w-full flex items-center justify-center gap-2 rounded-xl px-6 py-3 font-semibold text-white shadow-lg transition-all duration-200 hover:bg-slate-800 hover:shadow-xl active:scale-95"
                                        :class="following ? 'bg-pink-800' : 'bg-slate-900'">
                                        <span x-text="following ? 'Unfollow' : 'Follow'"></span>

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                    </button>
                                </div>
                                @endif

                            </x-follow-ctr>



                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>