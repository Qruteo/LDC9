<x-guest-layout>

    <div class="mb-6 text-center">

        <h1 class="text-2xl font-bold text-blue-800 dark:text-white">
            Selamat Datang
        </h1>

        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            Masuk ke sistem Classsync
        </p>

    </div>


    <!-- Session Status -->
    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />


    <form method="POST" action="{{ route('login') }}">

        @csrf


        <!-- ROLE -->
        <div>

            <x-input-label
                for="role"
                value="Masuk sebagai"
                class="text-sm font-medium text-gray-700 dark:text-gray-300"
            />

            <div class="grid grid-cols-3 gap-3 mt-2">

                <!-- ADMIN -->
                <label class="cursor-pointer">

                    <input
                        type="radio"
                        name="role"
                        value="admin"
                        class="peer sr-only"
                    >

                    <div class="
                        flex flex-col items-center justify-center
                        p-3
                        border border-gray-300
                        rounded-xl
                        transition
                        peer-checked:border-blue-600
                        peer-checked:bg-blue-50
                        peer-checked:text-blue-700
                        hover:bg-gray-50
                    ">

                        <span class="text-2xl">
                            🛡️
                        </span>

                        <span class="mt-1 text-sm font-medium">
                            Admin
                        </span>

                    </div>

                </label>


                <!-- GURU -->
                <label class="cursor-pointer">

                    <input
                        type="radio"
                        name="role"
                        value="guru"
                        class="peer sr-only"
                    >

                    <div class="
                        flex flex-col items-center justify-center
                        p-3
                        border border-gray-300
                        rounded-xl
                        transition
                        peer-checked:border-blue-600
                        peer-checked:bg-blue-50
                        peer-checked:text-blue-700
                        hover:bg-gray-50
                    ">

                        <span class="text-2xl">
                            👨‍🏫
                        </span>

                        <span class="mt-1 text-sm font-medium">
                            Guru
                        </span>

                    </div>

                </label>


                <!-- SISWA -->
                <label class="cursor-pointer">

                    <input
                        type="radio"
                        name="role"
                        value="siswa"
                        class="peer sr-only"
                    >

                    <div class="
                        flex flex-col items-center justify-center
                        p-3
                        border border-gray-300
                        rounded-xl
                        transition
                        peer-checked:border-blue-600
                        peer-checked:bg-blue-50
                        peer-checked:text-blue-700
                        hover:bg-gray-50
                    ">

                        <span class="text-2xl">
                            🎓
                        </span>

                        <span class="mt-1 text-sm font-medium">
                            Siswa
                        </span>

                    </div>

                </label>

            </div>

            <x-input-error
                :messages="$errors->get('role')"
                class="mt-2"
            />

        </div>


        <!-- EMAIL -->
        <div class="mt-5">

            <x-input-label
                for="email"
                value="Email"
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


        <!-- PASSWORD -->
        <div class="mt-4">

            <x-input-label
                for="password"
                value="Password"
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


        <!-- REMEMBER & FORGOT PASSWORD -->
        <div class="flex items-center justify-between mt-4">

            <label
                for="remember_me"
                class="inline-flex items-center"
            >

                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="
                        rounded
                        border-gray-300
                        text-blue-600
                        shadow-sm
                        focus:ring-blue-500
                    "
                >

                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                    Ingat saya
                </span>

            </label>


            @if (Route::has('password.request'))

                <a
                    class="
                        text-sm
                        text-blue-600
                        hover:text-blue-700
                        hover:underline
                    "
                    href="{{ route('password.request') }}"
                >
                    Lupa password?
                </a>

            @endif

        </div>


        <!-- LOGIN BUTTON -->
        <div class="mt-6">

            <x-primary-button
                class="w-full justify-center py-3"
            >

                {{ __('Masuk') }}

            </x-primary-button>

        </div>

    </form>

</x-guest-layout>