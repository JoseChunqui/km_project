@component('mail::message')
# Cuestionario KM

Ingresa al siguiente link para llenar el formulario.

@component('mail::button', ['url' => $url])
Link del cuestionario
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
