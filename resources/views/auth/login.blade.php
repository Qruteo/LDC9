<x-guest-layout>

    <div class="mb-6 text-center">

        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center shadow-sm">
                <span class="text-white text-xl font-bold">✓</span>
            </div>
        </div>

        <!-- Title -->
        <h1 class="text-2xl font-bold text-blue-800 dark:text-white">
            Classsync
        </h1>

        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            Selamat datang kembali 👋
        </p>

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Masuk ke akun Classsync Anda
        </p>

    </div>


    <!-- Session Status -->
    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />


    <form method="POST" action="{{ route('login') }}">

        @csrf


        <!-- Role Selection -->
        <div>

            <x-input-label
                value="Masuk sebagai"
                class="text-sm font-medium text-gray-700 dark:text-gray-300"
            />

            <div class="grid grid-cols-3 gap-3 mt-2">

                <!-- ADMIN -->
                <button
                    type="button"
                    data-role="admin"
                    class="role-card group flex flex-col items-center justify-center
                           h-24 rounded-xl border-2 border-gray-200
                           bg-white dark:bg-gray-800 dark:border-gray-700
                           hover:border-blue-500 hover:bg-blue-50
                           dark:hover:bg-gray-700
                           transition-all duration-200"
                >

                    <div class="w-10 h-10 rounded-full bg-blue-50
                                flex items-center justify-center
                                group-hover:bg-blue-100 transition">

                        <span class="text-xl">👑</span>

                    </div>

                    <span class="mt-2 text-sm font-semibold text-gray-700
                                 dark:text-gray-300">
                        Admin
                    </span>

                </button>


                <!-- GURU -->
                <button
                    type="button"
                    data-role="guru"
                    class="role-card group flex flex-col items-center justify-center
                           h-24 rounded-xl border-2 border-gray-200
                           bg-white dark:bg-gray-800 dark:border-gray-700
                           hover:border-blue-500 hover:bg-blue-50
                           dark:hover:bg-gray-700
                           transition-all duration-200"
                >

                    <div class="w-10 h-10 rounded-full bg-blue-50
                                flex items-center justify-center
                                group-hover:bg-blue-100 transition">

                        <span class="text-xl">👨‍🏫</span>

                    </div>

                    <span class="mt-2 text-sm font-semibold text-gray-700
                                 dark:text-gray-300">
                        Guru
                    </span>

                </button>


                <!-- SISWA -->
                <button
                    type="button"
                    data-role="siswa"
                    class="role-card group flex flex-col items-center justify-center
                           h-24 rounded-xl border-2 border-gray-200
                           bg-white dark:bg-gray-800 dark:border-gray-700
                           hover:border-blue-500 hover:bg-blue-50
                           dark:hover:bg-gray-700
                           transition-all duration-200"
                >

                    <div class="w-10 h-10 rounded-full bg-blue-50
                                flex items-center justify-center
                                group-hover:bg-blue-100 transition">

                        <span class="text-xl">🎓</span>

                    </div>

                    <span class="mt-2 text-sm font-semibold text-gray-700
                                 dark:text-gray-300">
                        Siswa
                    </span>

                </button>

            </div>

            <!-- Hidden Role Input -->
            <input
                type="hidden"
                name="role"
                id="role"
                value="siswa"
            />

        </div>


        <!-- Email -->
        <div class="mt-5">

            <x-input-label
                for="email"
                :value="__('Email')"
                class="text-sm font-medium text-gray-700 dark:text-gray-300"
            />

            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                placeholder="Masukkan email Anda"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />

        </div>


        <!-- Password -->
        <div class="mt-4">

            <x-input-label
                for="password"
                :value="__('Password')"
                class="text-sm font-medium text-gray-700 dark:text-gray-300"
            />

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                placeholder="Masukkan password Anda"
                required
                autocomplete="current-password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>


        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-4">

            <label
                for="remember_me"
                class="inline-flex items-center"
            >

                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="rounded border-gray-300
                           dark:bg-gray-900
                           dark:border-gray-700
                           text-blue-600
                           shadow-sm
                           focus:ring-blue-500"
                >

                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Ingat saya') }}
                </span>

            </label>


            @if (Route::has('password.request'))

                <a
                    class="text-sm text-blue-600
                           hover:text-blue-700
                           hover:underline
                           rounded-md
                           focus:outline-none
                           focus:ring-2
                           focus:ring-blue-500"
                    href="{{ route('password.request') }}"
                >
                    {{ __('Lupa password?') }}
                </a>

            @endif

        </div>


        <!-- Login Button -->
        <div class="mt-6">

            <x-primary-button
                class="w-full justify-center
                       bg-blue-600
                       hover:bg-blue-700
                       focus:bg-blue-700
                       active:bg-blue-800"
            >
                {{ __('Masuk') }}
            </x-primary-button>

        </div>

    </form>


    <!-- Role Selection Script -->
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const roleCards = document.querySelectorAll('.role-card');
            const roleInput = document.getElementById('role');

            function selectRole(card) {

                // Reset semua card
                roleCards.forEach(function (item) {

                    item.classList.remove(
                        'border-blue-600',
                        'bg-blue-50',
                        'dark:bg-blue-900/20'
                    );

                    item.classList.add(
                        'border-gray-200'
                    );

                });


                // Aktifkan card yang dipilih
                card.classList.remove(
                    'border-gray-200'
                );

                card.classList.add(
                    'border-blue-600',
                    'bg-blue-50',
                    'dark:bg-blue-900/20'
                );


                // Simpan role
                roleInput.value = card.dataset.role;

            }


            // Event klik
            roleCards.forEach(function (card) {

                card.addEventListener('click', function () {

                    selectRole(card);

                });

            });


            // Default: Siswa
            const defaultRole =
                document.querySelector('[data-role="siswa"]');

            if (defaultRole) {

                selectRole(defaultRole);

            }

        });

    </script>

</x-guest-layout>