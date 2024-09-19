@props(['disabled' => false])

<input type="file" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-500
focus:border-indigo-500 focus:ring-indigo-500 px-2 py-0']) !!}>