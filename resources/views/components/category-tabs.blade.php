<ul class="flex flex-wrap -mb-px justify-center">
    <li class="mr-2">
        <a href="{{ route('dashboard') }}" 
           class="inline-block p-4 border-b rounded-t-base {{ !request('category') ? 'text-brand border-brand active' : 'border-transparent hover:text-brand hover:border-brand' }}"
           aria-current="page">
           All
        </a>
    </li>
    
    @foreach ($categories as $category)
        <li class="mr-2">
            <a href="{{ route('dashboard', ['category' => $category->id]) }}"
               class="inline-block p-4 border-b rounded-t-base {{ request('category') == $category->id ? 'text-brand border-brand active' : 'border-transparent hover:text-brand hover:border-brand' }}">
               {{ $category->name }}
            </a>
        </li>
    @endforeach
</ul>