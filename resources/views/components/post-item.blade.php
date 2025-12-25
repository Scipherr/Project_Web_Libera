
<div class="flex h-64 w-full bg-slate-900/80 backdrop-blur-md border border-white/10 rounded-xl shadow-lg mb-6 overflow-hidden transition-all hover:border-purple-500/50 hover:shadow-[0_0_20px_rgba(168,85,247,0.3)]">
    <div class="p-5 flex-1">
        <a href="{{ route('post.show',['username' =>$post->user->username,'post'=>$post->slug]) }}">
            <h5 class="mt-6 mb-2 text-2xl font-semibold tracking-tight text-heading">{{ $post->title }}</h5>
        </a>
        <div class="mb-6 text-body">
            {{ Str::words(strip_tags($post->content), 15) }}
        </div>
        <a href="{{ route('post.show',['username' =>$post->user->username,'post'=>$post->slug]) }}">
            <x-primary-button>
                Read more
                 <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 12H5m14 0-4 4m4-4-4-4" />
                </svg>
                 
            
            </x-primary-button>
            
           
        </a>
    </div>

    <div class="w-1/3 h-full bg-black relative shrink-0">
        <a href="{{ route('post.show',['username' =>$post->user->username,'post'=>$post->slug]) }}" class="block w-full h-full">
            @if($post->video)
                <div class="absolute inset-0 flex items-center justify-center z-10 pointer-events-none">
                     <div class="rounded-full bg-black/50 p-2 border border-white/20">
                         <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                     </div>
                </div>
                <video class="w-full h-full object-cover opacity-90 hover:opacity-100 transition-opacity" muted loop onmouseover="this.play()" onmouseout="this.pause();this.currentTime=0;">
                    <source src="{{ Storage::url($post->video) }}" type="video/webm">
                </video>
            @elseif($post->image)
                <img class="w-full h-full object-cover opacity-90 hover:opacity-100 transition-opacity"
                    src="{{ $post->pfpurl() }}" alt="{{ $post->title }}" />
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-700 bg-gray-900">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            @endif
        </a>
    </div>
</div>