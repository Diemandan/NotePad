<x-mail::message>
# it is Your TIME for FUN

Happy Birthday, {{$user->name}}!!!
<hr>

<x-mail::button :url="'http://notepad/login'">
Go to notepad
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
