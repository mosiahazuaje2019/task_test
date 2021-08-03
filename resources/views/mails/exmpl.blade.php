@component('mail::message')
    **{{$name}}**,  {{-- use double space for line break --}}

    {{$user->users->name}}

@endcomponent
