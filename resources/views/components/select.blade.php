<!-- resources/views/components/select.blade.php -->

@props([
'options' => [], // Array of options in the format [['id' => 'value', 'name' => 'display text']]
'selected' => null, // The currently selected value
'disabled' => false, // Whether the select should be disabled
])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-select rounded-md border-gray-300
    focus:border-indigo-500 focus:ring-indigo-500 shadow-sm']) !!}>
    <option value="" {{ is_null($selected) ? 'selected' : '' }}>Select an option</option>
    @foreach ($options as $option)
    <option value="{{ $option['id'] }}" {{ $selected == $option['id'] ? 'selected' : '' }}>
        {{ $option['name'] }}
    </option>
    @endforeach
</select>