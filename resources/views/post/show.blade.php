<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
               <h1 class ="text-2xl mb-4">{{ $post->title }}</h1>

               <div class="flex gap-4">    
               <x-user-pfp :user="$post->user"/>
                <!--Big boom-->
                <div>
                     <x-follow-ctr :user="$post->user" class="flex gap-2">
                    <a href ="{{ route('profile.show',$post->user) }}">{{ $post->user->name }}</a>
                    <a href="#" class="text-blue-800" x-text="following? 'Unfollow': 'Follow'" :class="following? 'text-pink-800' : 'text-blue-800'" @click="follow()"></a> <!-- folow button -->
                </x-follow-ctr>
                    
                   
                    <div class="flex gap-2 text-sm">
                        {{$post->readmin() }} min read
                        
                        {{ $post->created_at->format('M d,Y') }}
                    </div>
                    <x-like-button/>
                    </div>
                    
                </div>
               <!---->
               <div>

               </div>
              <!--BODY!-------------------------------------------------------------------->
            </div>
              <!--Post image-->
               <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                                @if ($post->image)
                    <div class="mb-8 rounded-xl overflow-hidden shadow-lg">
                        <img src="{{ $post->pfpurl() }}" ... >
                    </div>
                @endif
                @if ($post->video)
                    <div class="mb-8 rounded-xl overflow-hidden shadow-lg bg-black">
                        <video controls class="w-full h-auto" preload="metadata">
                            <source src="{{ Storage::url($post->video) }}" type="video/webm">
                            <source src="{{ Storage::url($post->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @endif
                <!--Post content-->

                <div class="mt-4 prose max-w-none">
                    {!! $post->content !!}
                </div>
            </hr>
                <div class="mt-4">
                    <span class="px-4 py-2 bg-red-700 rounded-xl text-white">{{ $post->category->name }}</span>
                
                </div>
               <x-like-button/>
        </div>
    </div>
</x-app-layout>