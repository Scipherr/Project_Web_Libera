@props(['posts'])

@if($posts->isNotEmpty())
<div x-data="{ 
        activeSlide: 0,
        slides: {{ $posts->count() }},
        interval: null,
        init() {
            this.interval = setInterval(() => {
                this.next();
            }, 5000);
        },
        next() {
            this.activeSlide = (this.activeSlide + 1) % this.slides;
        },
        prev() {
            this.activeSlide = (this.activeSlide - 1 + this.slides) % this.slides;
        }
    }" 
    class="relative w-full overflow-hidden rounded-xl shadow-lg h-96 mb-8 group bg-gray-900"
>
    <div class="relative h-full w-full">
        @foreach($posts as $index => $post)
            <div x-show="activeSlide === {{ $index }}"
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-700"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 w-full h-full"
            >
                @if($post->pfpurl())
                    <img src="{{ $post->pfpurl() }}" 
                         alt="{{ $post->title }}" 
                         class="w-full h-full object-cover brightness-50 transition-transform duration-700 group-hover:scale-105">
                @else
                    <div class="w-full h-full bg-gray-800 flex items-center justify-center text-gray-600">
                        No Image
                    </div>
                @endif
                
               <div class="absolute inset-0 flex flex-col items-center justify-center z-10 bg-black/40">
                     <a href="{{ route('post.show',['username' =>$post->user->username,'post'=>$post->slug]) }}">
                        <h2 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight drop-shadow-xl hover:text-indigo-400 transition-colors">
                            {{ $post->title }}
                        </h2>
                        <span class="inline-block mt-4 px-6 py-2 border-2 border-white text-white font-bold text-sm tracking-widest uppercase rounded-full hover:bg-white hover:text-black transition-all">
                            Read Article
                        </span>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <button @click="prev(); clearInterval(interval)" class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/60 text-white p-3 rounded-full opacity-0 group-hover:opacity-100 transition-all transform hover:scale-110 backdrop-blur-sm border border-white/10">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
    </button>
    <button @click="next(); clearInterval(interval)" class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/60 text-white p-3 rounded-full opacity-0 group-hover:opacity-100 transition-all transform hover:scale-110 backdrop-blur-sm border border-white/10">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
    </button>

    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex space-x-3 z-20">
        @foreach($posts as $index => $post)
            <button @click="activeSlide = {{ $index }}; clearInterval(interval)" 
                    :class="activeSlide === {{ $index }} ? 'bg-white w-8 scale-110' : 'bg-white/40 w-2 hover:bg-white/80'" 
                    class="h-2 rounded-full transition-all duration-300 shadow-sm">
            </button>
        @endforeach
    </div>
</div>
@endif