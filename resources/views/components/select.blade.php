@props(['disabled' => false, 'options' => [], 'placeholder' => 'Select'])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm',
]) !!}>
    <option value="">{{ __($placeholder) }}</option>
    @foreach ($options as $option)
        <option value="{{ __($option) }}">{{ __($option) }}</option>
    @endforeach
</select>
