<nav x-data="{ open: false }" class="bg-black/60 backdrop-blur-xl border-b border-white/10 sticky top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="transition-transform hover:scale-105 hover:drop-shadow-[0_0_10px_rgba(168,85,247,0.5)]">
                        <x-application-logo class="block h-9 w-auto fill-current text-white" />
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-4">

                <a href="{{ route('post.create') }}" class="hidden sm:flex group items-center gap-2 bg-white/5 border border-white/10 text-gray-200 px-5 py-2.5 rounded-full font-medium text-sm transition-all shadow-lg hover:bg-white/10 hover:border-purple-500/50 hover:text-white hover:shadow-purple-500/20 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 group-hover:text-purple-400 transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    <span>Write</span>
                </a>

                @auth
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="bg-white/10 inline-flex items-center gap-2 px-3 py-2 border border-white/10 text-sm leading-4 font-medium rounded-full text-gray-200 hover:text-white hover:bg-white/20 hover:border-white/30 focus:outline-none transition ease-in-out duration-150">
                                    <div class="h-8 w-8 rounded-full flex items-center justify-center overflow-hidden ring-2 ring-transparent group-hover:ring-purple-500/50 transition-all">
                                         <x-user-pfp :user="Auth::user()" class="w-8 h-8 rounded-full object-cover" />
                                    </div>
                                    
                                    <span class="hidden md:block">{{ Auth::user()->name }}</span>

                                    <svg class="fill-current h-4 w-4 text-gray-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.show',Auth::user())">
                                    {{ __('My Profile') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Edit Profile') }}
                                </x-dropdown-link>
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();" class="text-red-500 hover:text-red-600 hover:bg-red-50">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth

                @guest
                    <div class="hidden sm:flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white font-medium text-sm transition-colors hover:drop-shadow-[0_0_8px_rgba(255,255,255,0.5)]">Login</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-500 hover:to-blue-500 text-white px-5 py-2 rounded-full font-medium text-sm transition-all shadow-lg shadow-purple-900/40 border border-white/10">
                            Sign up
                        </a>
                    </div>
                @endguest

                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-white/10 focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-800 bg-black/90 backdrop-blur-xl absolute w-full left-0 shadow-2xl">
        
        <div class="pt-4 pb-4 px-4">
             <a href="{{ route ('post.create')}}" class="flex items-center justify-center w-full gap-2 bg-gradient-to-r from-purple-900/50 to-blue-900/50 text-white border border-white/20 py-2.5 rounded-lg font-medium hover:bg-white/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-purple-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                Write a Post
            </a>
        </div>

        @auth
            <div class="pt-4 pb-4 border-t border-gray-800">
                <div class="px-4 flex items-center gap-3">
                     <div class="h-10 w-10 rounded-full bg-indigo-900/50 flex items-center justify-center text-indigo-300 font-bold uppercase border border-indigo-500/30">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-300 hover:text-white hover:bg-white/5">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();" class="text-red-400 hover:text-red-300 hover:bg-red-900/20">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
        
        @guest
             <div class="pt-4 pb-6 border-t border-gray-800 space-y-3 px-4">
                <a href="{{ route('login') }}" class="block text-center w-full py-2.5 text-gray-300 hover:text-white font-medium border border-gray-700 rounded-lg">Login</a>
                <a href="{{ route('register') }}" class="block text-center w-full py-2.5 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg font-medium shadow-lg shadow-purple-900/30">Sign Up</a>
             </div>
        @endguest
    </div>
</nav>