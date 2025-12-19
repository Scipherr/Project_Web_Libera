<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8 sm:py-12">
        <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <header class="text-center mb-10">
                @if($post->category)
                    <div class="mb-4">
                        <a href="{{ route('dashboard', ['category' => $post->category->id]) }}" 
                           class="inline-block px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-bold uppercase tracking-wider rounded-full hover:bg-indigo-200 transition-colors">
                            {{ $post->category->name }}
                        </a>
                    </div>
                @endif

                <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-6">
                    {{ $post->title }}
                </h1>

                <div class="flex items-center justify-center gap-4">
                    <div class="flex-shrink-0">
                        <x-user-pfp :user="$post->user" class="w-12 h-12 rounded-full ring-2 ring-white shadow-sm" />
                    </div>

                    <div class="text-left" x-data="{
                        following: {{ auth()->check() && $post->user->isFollowedBy(auth()->user()) ? 'true' : 'false' }},
                        follow() {
                            this.following = !this.following;
                            axios.post('{{ route('follow', $post->user) }}')
                                .catch(() => this.following = !this.following);
                        }
                    }">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('profile.show', $post->user) }}" class="font-bold text-gray-900 hover:text-indigo-600 transition-colors">
                                {{ $post->user->name }}
                            </a>
                            
                            @auth
                                @if(auth()->id() !== $post->user->id)
                                    <span class="text-gray-300">&bull;</span>
                                    <button 
                                        @click="follow()" 
                                        class="text-sm font-semibold transition-colors focus:outline-none"
                                        :class="following ? 'text-gray-500 hover:text-red-500' : 'text-indigo-600 hover:text-indigo-800'"
                                        x-text="following ? 'Unfollow' : 'Follow'">
                                    </button>
                                @endif
                            @endauth
                        </div>

                        <div class="flex items-center text-sm text-gray-500 gap-2">
                            <time datetime="{{ $post->created_at->format('Y-m-d') }}">
                                {{ $post->created_at->format('M d, Y') }}
                            </time>
                            <span>&bull;</span>
                            <span>{{ $post->readmin() }} min read</span>
                        </div>
                    </div>
                </div>
            </header>

            <div class="mb-10 rounded-2xl overflow-hidden shadow-xl bg-gray-200">
                <img src="{{ $post->pfpurl() }}" 
                     alt="{{ $post->title }}" 
                     class="w-full h-auto object-cover max-h-[500px]">
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-8 md:p-12">
                <div class="prose prose-lg prose-indigo mx-auto text-gray-700 max-w-none">
                    {!! $post->content !!}
                </div>

                <hr class="my-8 border-gray-100">

                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    
                    <x-like-button />

                    <div class="flex gap-2">
                         <span class="text-gray-400 text-sm">
                             Posted in <span class="font-medium text-gray-600">{{ $post->category->name }}</span>
                         </span>
                    </div>
                </div>
            </div>

        </article>
    </div>
</x-app-layout>