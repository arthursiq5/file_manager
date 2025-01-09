@props(['disabled' => false])

<input
    type="file"
    label="Choose file"
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => 'hidden opacity-0'
    ]) }}
>
