@props(['user'])



<div {{ $attributes }} x-data="{
    following: {{ auth()->check() && $user->isFollowedBy(auth()->user()) ? 'true' : 'false' }},
    followersCount:{{ $user-> followers()->count()}},
    follow(){
        this.following = !this.following;
        axios.post('/follow/{{ $user->id }}')
        .then(
        res => { console.log(res.data) 
        this.followersCount = res.data.followersCount
        })
        .catch(err => {
            console.log(err);
            this.following = !this.following; // Revert on error
        })
    }
}" class="px-6 pb-6 relative">
{{ $slot }}

</div>