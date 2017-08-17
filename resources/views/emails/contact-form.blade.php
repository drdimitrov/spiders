@component('mail::message')
# Contact form message

Message from Balkan spiders contact form <br>

by {{ $name }} ({{ $email }}) <br>
Subject: {{ $subject }} <br><br>

Message: {{ $body }}


@endcomponent