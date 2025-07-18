<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bảng điều khiển') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Lời chào mừng -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold">Chào mừng trở lại, {{ Auth::user()->name }}!</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">Đây là khu vực quản lý của bạn. Chúc bạn một ngày làm việc hiệu quả.</p>
                </div>
            </div>

            <!-- Các thẻ thống kê (Stat Cards) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Thẻ 1: HV Đang học -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-start justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">HV Đang học</h4>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $totalActiveStudents }}</p>
                    </div>
                    <div class="bg-blue-100 dark:bg-blue-500/20 p-3 rounded-full">
                        {{-- SỬA Ở ĐÂY: Thêm lại code SVG --}}
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-2.272M15 19.128v-3.872M15 19.128L11.03 15.152a3.75 3.75 0 0 0-4.242-4.242L6.75 15.152M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                </div>

                <!-- Thẻ 2: Lịch học hôm nay -->
                 <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-start justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">Lịch học hôm nay</h4>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $schedulesToday }}</p>
                    </div>
                    <div class="bg-green-100 dark:bg-green-500/20 p-3 rounded-full">
                        {{-- SỬA Ở ĐÂY: Thêm lại code SVG --}}
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0h18" /></svg>
                    </div>
                </div>

                <!-- Thẻ 3: Học viên mới trong tháng -->
                 <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-start justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">HV mới tháng này</h4>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $newStudentsThisMonth }}</p>
                    </div>
                    <div class="bg-yellow-100 dark:bg-yellow-500/20 p-3 rounded-full">
                        {{-- SỬA Ở ĐÂY: Thêm lại code SVG --}}
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" /></svg>
                    </div>
                </div>

                <!-- Thẻ 4: Truy cập nhanh -->
                 <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col justify-center items-center">
                    <a href="{{ route('students.index') }}" class="w-full text-center text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
                        Quản lý Học viên
                    </a>
                 </div>
            </div>

            <!-- Danh sách học viên đăng ký gần đây -->
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Học viên đăng ký gần đây</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <tbody>
                            @forelse ($recentStudents as $student)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-6 py-4 flex items-center">
                                        @if ($student->avatar)
                                            <img src="{{ asset('storage/' . $student->avatar) }}" alt="Avatar" class="h-10 w-10 object-cover rounded-full">
                                        @else
                                            <span class="inline-block h-10 w-10 rounded-full overflow-hidden bg-gray-100"><svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg></span>
                                        @endif
                                        <span class="ml-4 font-medium text-gray-900 dark:text-white">{{ $student->full_name }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 dark:text-gray-400">ĐK: {{ \Carbon\Carbon::parse($student->enrollment_date)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('students.show', $student->id) }}" class="font-medium text-blue-600 hover:underline">Xem chi tiết</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-6 py-4 text-center text-gray-500">Chưa có học viên nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>