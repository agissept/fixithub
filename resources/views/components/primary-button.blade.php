<button {{ $attributes->merge(
         [
            'type' => 'submit',
            'class' => 'inline-flex items-center bg-blue-primary text-white px-4 py-2'
        ]
    ) }}>
    {{ $slot }}
</button>
