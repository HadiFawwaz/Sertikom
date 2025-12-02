@php
    $menu = [
        ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => '🏠'],
        ['label' => 'Siswa', 'route' => 'siswa.index', 'icon' => '👨‍🎓'],
        ['label' => 'Kelas', 'route' => 'kelas.index', 'icon' => '🏫'],
        ['label' => 'Jurusan', 'route' => 'jurusan.index', 'icon' => '📚'],
        ['label' => 'Tahun Ajar', 'route' => 'tahun_ajar.index', 'icon' => '📅'],
        ['label' => 'User', 'route' => 'users.index', 'icon' => '👥'],
    ];
@endphp

{{-- NAVBAR MOBILE --}}
<div class="md:hidden fixed top-0 left-0 right-0 h-16 bg-white shadow-lg z-50 flex items-center justify-between px-4">
    <button 
        @click="sidebarOpen = !sidebarOpen" 
        class="p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>

    <div class="text-center">
        <div class="font-semibold text-gray-800 text-sm">{{ Auth::user()->name }}</div>
        <div class="text-gray-500 text-xs">Administrator</div>
    </div>

    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-700">
        {{ substr(Auth::user()->name, 0, 1) }}
    </div>
</div>

{{-- OVERLAY MOBILE --}}
<div 
    x-show="sidebarOpen"
    @click="sidebarOpen = false"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
    style="display: none;">
</div>

{{-- SIDEBAR --}}
<aside 
    class="fixed top-0 left-0 h-full w-64 bg-white shadow-xl z-50 
           transform transition-transform duration-300 ease-in-out
           md:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
    x-show="true"
    style="display: block;"
>

    {{-- LOGO --}}
    <div class="px-6 py-6 border-b border-gray-200">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center text-white font-bold text-lg">
                S
            </div>
            <div>
                <div class="text-lg font-bold text-gray-900">Sistem Sekolah</div>
                <div class="text-sm text-gray-500 -mt-1">Management System</div>
            </div>
        </div>
    </div>

    {{-- MENU --}}
    <div class="px-4 mt-6 overflow-y-auto h-[calc(100%-180px)]">
        <div class="text-xs text-gray-500 font-medium tracking-wider mb-3 px-4">NAVIGASI</div>

        @foreach($menu as $item)
            @php
                $active =
                    request()->routeIs($item['route']) ||
                    request()->is(trim(parse_url(route($item['route']), PHP_URL_PATH), '/') . '*');
            @endphp

            <a href="{{ route($item['route']) }}"
               @click="if (window.innerWidth < 768) sidebarOpen = false"
               class="flex items-center gap-3 px-4 py-3 rounded-lg mb-1 transition font-medium 
                      {{ $active 
                          ? 'bg-gray-900 text-white border-r-4 border-gray-900' 
                          : 'text-gray-700 hover:bg-gray-50 border-r-4 border-transparent' }}">
                <span class="text-lg">{{ $item['icon'] }}</span>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </div>

    {{-- PROFILE + LOGOUT --}}
    <div class="absolute bottom-0 left-0 w-full px-4 py-5 border-t border-gray-200 bg-white">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-700">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>

            <div class="flex-1">
                <div class="font-medium text-gray-900 text-sm">{{ Auth::user()->name }}</div>
                <div class="text-gray-500 text-xs">Administrator</div>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center justify-center gap-2 bg-red-50 text-red-600 border border-red-200 py-2.5 rounded-lg font-medium hover:bg-red-100 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </button>
        </form>
    </div>

</aside>