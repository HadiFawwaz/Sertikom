<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Script untuk konfirmasi delete -->
    <script>
        function confirmDelete(event, formId, itemName, type = '') {
            event.preventDefault();
            
            let title = 'Apakah kamu yakin?';
            let text = type ? 
                `Data ${type} "${itemName}" akan dihapus permanen.` : 
                `Data "${itemName}" akan dihapus permanen.`;
            
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
        
        // Fungsi untuk menampilkan notifikasi sukses dari Laravel session
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            @endif
            
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            @endif
        });
    </script>
    
    @stack('styles')
</head>

<body class="bg-gray-50 font-sans antialiased" x-data="{ sidebarOpen: false }">
    
    {{-- Navigation --}}
    @include('layouts.navigation')

    {{-- Main Content Area --}}
    <div class="min-h-screen 
                pt-16          {{-- untuk navbar mobile --}}
                md:ml-64       {{-- untuk sidebar lebar 64 --}}
                md:pt-0        {{-- desktop tidak perlu padding top --}}
                transition-all duration-300">
        
        {{-- Header Section --}}
        @if(isset($header))
            <div class="px-4 md:px-6 pt-6">
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                    {{ $header }}
                </div>
            </div>
        @endif
        
        {{-- Main Content --}}
        <main class="px-4 md:px-6 py-6">
            {{ $slot }}
        </main>

    </div>

    @stack('scripts')
</body>
</html>