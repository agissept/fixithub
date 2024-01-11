<button {{ $attributes->merge(
         [
            'type' => 'submit',
            'class' => 'inline-flex items-center bg-blue-primary text-white'
        ]
    ) }}>
    {{ $slot }}
</button>
