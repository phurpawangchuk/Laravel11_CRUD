<div>
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <x-authentication-card-logo class="block h-9 w-auto" />
                    </div>
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <a href="{{ url('/') }}"
                            class="text-gray-900 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                        <a href="{{ url('/about') }}"
                            class="text-gray-900 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">About</a>
                        <a href="{{ url('/contact') }}"
                            class="text-gray-900 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                    </div>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <a href="{{ route('login') }}"
                        class="text-gray-900 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                    <a href="{{ route('register') }}"
                        class="ml-4 bg-indigo-600 text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>
                </div>
            </div>
        </div>
    </nav>
</div>