<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script>
      // Set sidebar state class before CSS loads
      var sidebarOpen = localStorage.getItem('sidebarOpen');
      if (sidebarOpen === 'false') {
        document.documentElement.classList.add('sidebar-collapsed');
      } else {
        document.documentElement.classList.add('sidebar-expanded');
      }
      if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
      }
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Basirah Admin</title>
    <link rel="icon" type="image/png" href="/images/Basirah Logo Mark (Full Color).jpg">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 transition-colors duration-300" x-data>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('theme', {
            dark: localStorage.getItem('theme') === 'dark',
            toggle() {
                this.dark = !this.dark;
                localStorage.setItem('theme', this.dark ? 'dark' : 'light');
                document.documentElement.classList.toggle('dark', this.dark);
            }
        });
        document.documentElement.classList.toggle('dark', Alpine.store('theme').dark);
    });
</script>
    <div class="min-h-screen flex bg-gray-100 dark:bg-[#181C2F]">
        <!-- Sidebar -->
        <aside x-data="{
            open: localStorage.getItem('sidebarOpen') !== 'false',
            showText: localStorage.getItem('sidebarOpen') !== 'false',
            init() {
                this.$watch('open', value => {
                    localStorage.setItem('sidebarOpen', value);
                    document.documentElement.classList.toggle('sidebar-collapsed', !value);
                    document.documentElement.classList.toggle('sidebar-expanded', value);
                    if (value) {
                        setTimeout(() => { this.showText = true }, 300); // match sidebar width transition
                    } else {
                        this.showText = false;
                    }
                });
            }
        }" x-init="init()" :class="open ? 'w-64' : 'w-20'" class="fixed z-40 flex flex-col h-screen bg-white dark:bg-[#23294D] border-r border-gray-200 dark:border-blue-900/40 shadow-lg dark:shadow-blue-900/20 transition-all duration-300">
            <!-- Collapse/Expand Button -->
            <button @click="open = !open" class="absolute top-4 right-[-16px] w-8 h-8 bg-blue-600 dark:bg-yellow-400 text-white dark:text-gray-900 rounded-full shadow flex items-center justify-center focus:outline-none border-4 border-white dark:border-[#23294D] transition-all duration-300 z-50">
                <span class="material-icons" x-show="open" x-cloak>chevron_left</span>
                <span class="material-icons" x-show="!open" x-cloak>chevron_right</span>
            </button>
            <!-- Logo -->
            <div class="flex items-center justify-center h-20 border-b border-gray-200 dark:border-blue-900/40 transition-all duration-300">
                <img src="/images/Basirah Logo Full Color(Transparent).png" alt="Basirah Logo" class="block dark:hidden h-12 w-auto transition-all duration-300" x-show="open" x-cloak>
                <img src="/images/Basirah Logo Mark (Inverse).jpg" alt="Basirah Logo" class="hidden dark:block h-12 w-auto transition-all duration-300" x-show="open" x-cloak>
                <img src="/images/Basirah Logo Mark (Inverse).jpg" alt="Basirah Logo" class="h-8 w-8 transition-all duration-300" x-show="!open" x-cloak>
            </div>
            <!-- Navigation Links -->
            <nav class="flex-1 px-2 py-6 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="relative flex items-center gap-3 px-4 py-2 rounded-lg text-base font-medium transition-colors duration-200 hover:bg-blue-100 dark:hover:bg-blue-900/30 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-yellow-300 font-bold' : 'text-gray-700 dark:text-gray-200' }}">
                    @if(request()->routeIs('admin.dashboard'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded bg-blue-600 dark:bg-yellow-400 transition-all duration-300"></span>
                    @endif
                    <span class="material-icons">dashboard</span>
                    <span x-show="showText" x-cloak class="">Dashboard</span>
                </a>
                <a href="{{ route('admin.contact-messages.index') }}" class="relative flex items-center gap-3 px-4 py-2 rounded-lg text-base font-medium transition-colors duration-200 hover:bg-blue-100 dark:hover:bg-blue-900/30 {{ request()->routeIs('admin.contact-messages.*') ? 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-yellow-300 font-bold' : 'text-gray-700 dark:text-gray-200' }}">
                    @if(request()->routeIs('admin.contact-messages.*'))
                        <span class="absolute left-0 top-2 bottom-2 w-1 rounded bg-blue-600 dark:bg-yellow-400 transition-all duration-300"></span>
                    @endif
                    <span class="material-icons">mail</span> <span x-show="showText" x-cloak class="transition-all duration-300">Messages</span>
                    @php $unread = isset($unreadMessagesCount) ? $unreadMessagesCount : 0; @endphp
                    @if($unread > 0)
                        <span class="ml-2 inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white bg-red-600 rounded-full" x-show="showText" x-cloak>{{ $unread }}</span>
                    @endif
                </a>
                <!-- Content Dropdown as section -->
                <div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 uppercase px-4 mt-4 mb-1" x-show="showText" x-cloak>Content</div>
                    <a href="{{ route('admin.about.index') }}" class="relative flex items-center gap-3 px-4 py-2 rounded-lg text-base font-medium transition-colors duration-200 hover:bg-blue-100 dark:hover:bg-blue-900/30 {{ request()->routeIs('admin.about.*') ? 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-yellow-300 font-bold' : 'text-gray-700 dark:text-gray-200' }}">
                        @if(request()->routeIs('admin.about.*'))
                            <span class="absolute left-0 top-2 bottom-2 w-1 rounded bg-blue-600 dark:bg-yellow-400 transition-all duration-300"></span>
                        @endif
                        <span class="material-icons">info</span> <span x-show="showText" x-cloak class="transition-all duration-300">About</span>
                    </a>
                    <a href="{{ route('admin.hero.index') }}" class="relative flex items-center gap-3 px-4 py-2 rounded-lg text-base font-medium transition-colors duration-200 hover:bg-blue-100 dark:hover:bg-blue-900/30 {{ request()->routeIs('admin.hero.*') ? 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-yellow-300 font-bold' : 'text-gray-700 dark:text-gray-200' }}">
                        @if(request()->routeIs('admin.hero.*'))
                            <span class="absolute left-0 top-2 bottom-2 w-1 rounded bg-blue-600 dark:bg-yellow-400 transition-all duration-300"></span>
                        @endif
                        <span class="material-icons">slideshow</span> <span x-show="showText" x-cloak class="transition-all duration-300">Hero Slides</span>
                    </a>
                    <a href="{{ route('admin.reviews.index') }}" class="relative flex items-center gap-3 px-4 py-2 rounded-lg text-base font-medium transition-colors duration-200 hover:bg-blue-100 dark:hover:bg-blue-900/30 {{ request()->routeIs('admin.reviews.*') ? 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-yellow-300 font-bold' : 'text-gray-700 dark:text-gray-200' }}">
                        @if(request()->routeIs('admin.reviews.*'))
                            <span class="absolute left-0 top-2 bottom-2 w-1 rounded bg-blue-600 dark:bg-yellow-400 transition-all duration-300"></span>
                        @endif
                        <span class="material-icons">rate_review</span> <span x-show="showText" x-cloak class="transition-all duration-300">Reviews</span>
                    </a>
                    <a href="{{ route('admin.promotion.index') }}" class="relative flex items-center gap-3 px-4 py-2 rounded-lg text-base font-medium transition-colors duration-200 hover:bg-blue-100 dark:hover:bg-blue-900/30 {{ request()->routeIs('admin.promotion.*') ? 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-yellow-300 font-bold' : 'text-gray-700 dark:text-gray-200' }}">
                        @if(request()->routeIs('admin.promotion.*'))
                            <span class="absolute left-0 top-2 bottom-2 w-1 rounded bg-blue-600 dark:bg-yellow-400 transition-all duration-300"></span>
                        @endif
                        <span class="material-icons">local_offer</span> <span x-show="showText" x-cloak class="transition-all duration-300">Promotions</span>
                    </a>
                    <a href="{{ route('admin.offers.index') }}" class="relative flex items-center gap-3 px-4 py-2 rounded-lg text-base font-medium transition-colors duration-200 hover:bg-blue-100 dark:hover:bg-blue-900/30 {{ request()->routeIs('admin.offers.*') ? 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-yellow-300 font-bold' : 'text-gray-700 dark:text-gray-200' }}">
                        @if(request()->routeIs('admin.offers.*'))
                            <span class="absolute left-0 top-2 bottom-2 w-1 rounded bg-blue-600 dark:bg-yellow-400 transition-all duration-300"></span>
                        @endif
                        <span class="material-icons">card_giftcard</span> <span x-show="showText" x-cloak class="transition-all duration-300">Offers</span>
                    </a>
                    <a href="{{ route('admin.contact.index') }}" class="relative flex items-center gap-3 px-4 py-2 rounded-lg text-base font-medium transition-colors duration-200 hover:bg-blue-100 dark:hover:bg-blue-900/30 {{ request()->routeIs('admin.contact.*') ? 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-yellow-300 font-bold' : 'text-gray-700 dark:text-gray-200' }}">
                        @if(request()->routeIs('admin.contact.*'))
                            <span class="absolute left-0 top-2 bottom-2 w-1 rounded bg-blue-600 dark:bg-yellow-400 transition-all duration-300"></span>
                        @endif
                        <span class="material-icons">contacts</span> <span x-show="showText" x-cloak class="transition-all duration-300">Contacts</span>
                    </a>
                </div>
            </nav>
            <!-- Sidebar Bottom: Dark Mode Toggle & Account -->
            <div class="mt-auto flex flex-col items-center pb-6">
                <button @click="$store.theme.toggle()" class="p-2 rounded-full focus:outline-none border border-gray-300 dark:border-gray-700 bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-yellow-300 shadow transition-colors duration-300 mb-4" title="Toggle dark mode">
                    <span :class="$store.theme.dark ? 'hidden' : ''" class="material-icons">dark_mode</span>
                    <span :class="$store.theme.dark ? '' : 'hidden'" class="material-icons">light_mode</span>
                </button>
                {{--
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 text-gray-600 dark:text-gray-300 hover:text-blue-700 dark:hover:text-yellow-300 bg-transparent border-none p-0 m-0 cursor-pointer w-full text-left" title="Logout">
                        <span class="material-icons">logout</span> <span x-show="showText" x-cloak class="transition-all duration-300">Logout</span>
                    </button>
                </form>
                --}}
            </div>
        </aside>
        <!-- Main Content -->
        <div :class="open ? 'ml-64' : 'ml-20'" class="flex-1 transition-all duration-300 sidebar-main-content">
            <main class="py-8 px-4 md:px-8 w-full">
                @if (session('success') || session('persistent_success'))
                    <x-admin.notification>{{ session('success') ?? session('persistent_success') }}</x-admin.notification>
                @endif
                @if (session('persistent_error'))
                    <x-admin.notification-error>{{ session('persistent_error') }}</x-admin.notification-error>
                @endif
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transition-colors duration-300 w-full">
                @yield('content')
            </div>
        </main>
        </div>
    </div>
    <!-- Quick Add Floating Button -->
    <div x-data="{ quickAddOpen: false }" class="fixed bottom-8 right-8 z-50">
        <button @click="quickAddOpen = !quickAddOpen" class="bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg w-16 h-16 flex items-center justify-center focus:outline-none dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:text-gray-900 transition-colors duration-300">
            <span class="material-icons text-3xl">add</span>
        </button>
        <div x-show="quickAddOpen" @click.away="quickAddOpen = false" x-cloak class="mt-2 space-y-2 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 transition-colors duration-300">
            <a href="{{ route('admin.hero.create') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-800 dark:text-white">
                <span class="material-icons text-gray-800 dark:text-white">slideshow</span> Add Hero
            </a>
            <a href="{{ route('admin.about.create') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-800 dark:text-white">
                <span class="material-icons text-gray-800 dark:text-white">info</span> Add About
            </a>
            <a href="{{ route('admin.reviews.create') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-800 dark:text-white">
                <span class="material-icons text-gray-800 dark:text-white">rate_review</span> Add Review
            </a>
            <a href="{{ route('admin.promotion.create') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-800 dark:text-white">
                <span class="material-icons text-gray-800 dark:text-white">local_offer</span> Add Promotion
            </a>
            <a href="{{ route('admin.offers.create') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-800 dark:text-white">
                <span class="material-icons text-gray-800 dark:text-white">card_giftcard</span> Add Offer
            </a>
            <a href="{{ route('admin.contact.create') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-800 dark:text-white">
                <span class="material-icons text-gray-800 dark:text-white">contacts</span> Add Contact
            </a>
        </div>
    </div>
    <!-- Add extra spacing between dashboard cards on mobile -->
    <style>
    @media (max-width: 768px) {
      .grid > div { margin-bottom: 1.5rem; }
    }
    /* Ensure main content margin matches sidebar state immediately */
    html.sidebar-expanded .sidebar-main-content { margin-left: 16rem !important; }
    html.sidebar-collapsed .sidebar-main-content { margin-left: 5rem !important; }
    </style>
</body>
</html>
