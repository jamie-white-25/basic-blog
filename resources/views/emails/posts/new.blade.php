<x-mail::message>
    # New Posts

    @foreach($posts as $key => $post)
    {{$post->title}}
    @endforeach

    <x-mail::button :url="config('app.url')">
        See Posts
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>