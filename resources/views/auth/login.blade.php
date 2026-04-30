<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow">
            
            <h2 class="text-2xl font-bold text-center mb-6">
                LOGIN SOP
            </h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" 
                        class="block mt-1 w-full" 
                        type="email" 
                        name="email" 
                        required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" value="Password" />
                    <x-text-input id="password" 
                        class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="mt-4 flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="mr-2">
                    <label for="remember_me">Remember me</label>
                </div>

                <div class="flex items-center justify-between mt-6">
                    
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Login
                    </button>

                </div>
            </form>

        </div>

    </div>
</x-guest-layout>