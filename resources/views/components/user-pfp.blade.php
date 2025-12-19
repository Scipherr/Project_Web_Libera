@props (['user','size'=>'w-12 h-12'])

@if($user->image)
                    <img src="{{ $user->pfpurl() }}" alt="{{ $user->name }}" class="{{ $size }} rounded-full">
@else
<img src ="https://images.steamusercontent.com/ugc/2486625303486797048/1F6D8F38ABD85345B179CB9E74183F43A7676BE7/" alt="No pic" class="{{ $size }}rounded-full">
@endif