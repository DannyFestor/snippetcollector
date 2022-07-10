<nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-10 h-16 bg-slate-100 border-b border-slate-200">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-4 h-full">
        <div class="shrink-0 flex">
            <a href="{{ route('dashboard') }}"
               class="group block relative flex justify-center items-center min-w-[135px] rounded bg-slate-800 px-4 py-2"
            >
                <div class="text-3xl font-bold text-slate-100 transition-all group-hover:-translate-y-2">SC</div>
                <div
                    class="absolute text-slate-100 bottom-0 -translate-y-1/2 transition left-1/2 opacity-0 -translate-x-1/2 scale-0 group-hover:-translate-y-1 group-hover:opacity-100 group-hover:scale-100">
                    SnippetCollector
                </div>
            </a>
        </div>

        <!-- Hamburger -->
        <div class="ml-auto -mr-2 flex items-center md:hidden">
            <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div :class="open ? 'flex flex-col' : 'hidden'"
             class="absolute w-full md:w-auto top-16 left-0 md:left-auto md:relative md:top-0 bg-white md:bg-inherit md:flex md:flex-row md:flex-1 sm:justify-between h-full">
            <div class="flex flex-col md:flex-row items-stretch md:gap-4">
                @auth
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                @endauth

                <x-nav-link :href="route('snippets.index')" :active="request()->routeIs('snippets.*')">
                    {{ __('Snippets') }}
                </x-nav-link>

                <x-nav-link :href="route('tags.index')" :active="request()->routeIs('tags.*')">
                    {{ __('Categories') }}
                </x-nav-link>
            </div>

            @auth
                <div>
                    <form class="flex md:hidden w-full shadow" method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-nav-link :href="route('logout')"
                                    class="flex-1"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-nav-link>
                    </form>
                    <!-- Settings Dropdown -->
                    <div class="hidden md:flex md:items-center h-full">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            @else
                <div class="flex flex-col md:flex-row md:gap-4">
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        Login
                    </x-nav-link>
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        Register
                    </x-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>
