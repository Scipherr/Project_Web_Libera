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
                <img src="{{ $post->pfpurl() }}" alt="{{ $post->title }}" class="w-full">
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