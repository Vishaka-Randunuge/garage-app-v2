@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-primary-teal focus:ring-primary-teal rounded-md shadow-sm']) }}>
