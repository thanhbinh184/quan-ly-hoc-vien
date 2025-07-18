<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="h-screen flex flex-col">
            
            {{-- Navbar trên cùng --}}
            @include('layouts.navigation')

            {{-- Container chính cho nội dung bên dưới Navbar --}}
            <div class="flex flex-1 overflow-hidden">
                
                {{-- Cột 1: Sidebar --}}
                <div class="hidden sm:block">
                    @include('layouts.partials.sidebar')
                </div>

                {{-- Cột 2: Nội dung chính, cho phép cuộn --}}
                <div class="flex-1 overflow-y-auto">
                    <!-- Page Heading -->
                    @isset($header)
                        <header class="bg-white dark:bg-gray-800 shadow">
                            <div class="w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset

                    <!-- Page Content -->
                    <main>

                        {{-- Hiển thị thông báo (Notifications) --}}
                        @if (session('success'))
                            <div class="py-4 px-4 sm:px-6 lg:px-8">
                                <div class="p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                                    <span class="font-medium">Thành công!</span> {{ session('success') }}
                                </div>
                            </div>
                        @endif

                        @if (session('error'))
                             <div class="py-4 px-4 sm:px-6 lg:px-8">
                                <div class="p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                    <span class="font-medium">Lỗi!</span> {{ session('error') }}
                                </div>
                            </div>
                        @endif
                        {{-- === KẾT THÚC THÊM VÀO ĐÂY === --}}

                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>