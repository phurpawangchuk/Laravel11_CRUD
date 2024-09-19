    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <x-authentication-card-logo class="block h-9 w-auto" />
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')" wire:navigate>
                            {{ __('Home') }}
                        </x-nav-link>
                        @auth
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                            wire:navigate>
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        @endauth
                        <x-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')" wire:navigate>
                            {{ __('Contact') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')" wire:navigate>
                            {{ __('About') }}
                        </x-nav-link>

                        @auth
                        <x-nav-link href="{{ route('products') }}" :active="request()->routeIs('products')"
                            wire:navigate>
                            {{ __('Product') }}
                        </x-nav-link>

                        <x-nav-link href="{{ route('students') }}" :active="request()->routeIs('students')"
                            wire:navigate>
                            {{ __('Student') }}
                        </x-nav-link>

                        <x-nav-link href="{{ route('posts') }}" :active="request()->routeIs('posts')" wire:navigate>
                            {{ __('Post') }}
                        </x-nav-link>

                        <x-nav-link href="{{ route('customers') }}" :active="request()->routeIs('customers')"
                            wire:navigate>
                            {{ __('Customer') }}
                        </x-nav-link>
                        @endauth
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    @auth
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                                @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        @if (Auth::user())
                                        {{ Auth::user()->name }}
                                        @endif

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-dropdown-link href="{{ route('profile.show') }}" wire:navigate>
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @else
                    <a href="{{ route('login') }}"
                        class="text-gray-900 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                    <a href="{{ route('register') }}"
                        class="ml-4 bg-indigo-600 text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>