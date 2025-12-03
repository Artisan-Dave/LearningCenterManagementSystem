<header class="shadow mb-2 px-4 sticky top-0 z-50 bg-gray-300">
    <div class="relative mx-auto flex flex-col sm:flex-row max-w-screen-lg sm:items-center sm:justify-between py-4">
        <a href="" class="text-2xl flex items-center font-black" href="#">
            <span class="mr-2 text-blue-600 text-3xl"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="currentColor" class="size-6">
                    <path
                        d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                    <path
                        d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                    <path
                        d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
                </svg>
            </span>
            <span>Learning Center</span>
        </a>

        <label class="cursor-pointer absolute right-0 mt-1 text-xl sm:hidden" for="navbar-open">
            <span class="sr-only">Toggle Navigation</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </label>

        <input class="peer hidden" type="checkbox" name="navbar-open" id="navbar-open">

        <nav aria-label="Header Navigation" class="peer-checked:block hidden sm:mt-0 sm:block py-4 sm:py-0 bg-gray-300">
            <ul class="flex flex-col sm:flex-row sm:gap-x-8 items-center">
                <li class="hover:text-blue-600 text-gray-700">
                    <a href="#about" class="nav-link">About</a>
                </li>
                <li class="hover:text-blue-600 text-gray-700">
                    <a href="#contact" class="nav-link">Contact</a>
                </li>
                @auth
                    <li class=" mt-2 sm:mt-0">
                        <a href="{{ url('/dashboard') }}"
                            class="border-2 px-6 py-2 rounded-xl border-blue-600 font-medium text-blue-600 hover:bg-blue-600 hover:text-white">Dashboard</a>
                    </li>
                @else
                    <li class=" mt-2 sm:mt-0">
                        <a href="{{ route('login') }}"
                            class="border-2 px-6 py-2 rounded-xl border-blue-600 font-medium text-blue-600 hover:bg-blue-600 hover:text-white">Login</a>
                    </li>
                @endauth
                {{-- @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="hover:text-blue-600 text-gray-700">
                        Register
                    </a>
                @endif --}}
            </ul>
        </nav>
    </div>
</header>

@push('scripts')
    @vite('resources/js/welcomenav.js');
@endpush
