<x-mail::message>
User registered

your temporary password: {{$tempPassword}}

You'll need to set your own password 

<x-mail::button :url="$newPasswordUrl">
Set Password
</x-mail::button>
 
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>