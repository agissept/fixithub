<section>
    <header>
        <h2 class="text-lg font-bold color-blue-primary">
            Informasi Akun
        </h2>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                          required autofocus autocomplete="name"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                          :value="old('email', $user->email)" required autocomplete="username"/>
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
        </div>

        @if(auth()->user()->role === \App\Http\Enum\UserRole::CUSTOMER->value)
            <div>
                <x-input-label for="phone" :value="__('Nomor Telepon')"/>
                <x-text-input id="phone" name="phone_number" type="text" class="mt-1 block w-full"
                              :value="old('phone', $user->phone_number)" required autocomplete="phone"/>
                <x-input-error class="mt-2" :messages="$errors->get('phone_number')"/>
            </div>

            <div>
                <x-input-label for="address" :value="__('Alamat')"/>
                <textarea id="address" name="address" type="text" class="mt-1 block w-full h-24 resize-none border-gray rounded-[4px]"
                           required autocomplete="address">{{ old('address', $user->address) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('address')"/>
            </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
