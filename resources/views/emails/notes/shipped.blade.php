<x-mail::message>
# it is time to check Your notes

{{$note->name}}<br>
{{$note->description}}<hr>

<x-mail::button :url="'http://notepad/login'">
Go to notepad
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
