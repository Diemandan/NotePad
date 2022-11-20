<x-mail::message>
# it is time to check Your notes

{{$order->name}}<br>
{{$order->description}}<hr>

<x-mail::button :url="'http://notepad/login'">
Go to notepad
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
