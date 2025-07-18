<aside id="logo-sidebar" class="w-64 h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            {{-- BẢNG ĐIỀU KHIỂN --}}
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 rounded-lg group {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                   {{-- Icon Bảng điều khiển --}}
                   <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                      <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                      <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.026V10h8.975a1 1 0 0 0 1-.934A8.5 8.5 0 0 0 12.5 0Z"/>
                   </svg>
                   <span class="ms-3">Bảng điều khiển</span>
                </a>
            </li>

            {{-- NHÓM QUẢN LÝ CHÍNH --}}
            <li class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700"></li>
            
            {{-- QUẢN LÝ HỌC VIÊN --}}
            <li>
                <a href="{{ route('students.index') }}" class="flex items-center p-2 rounded-lg group {{ request()->routeIs('students.*') ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                   {{-- Icon Quản lý học viên --}}
                   <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                      <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                   </svg>
                   <span class="ms-3">Quản lý Học viên</span>
                </a>
            </li>
            
            {{-- QUẢN LÝ LỊCH HỌC (Sắp tới) --}}
            <li>
                <a href="{{ route('schedules.index') }}" class="flex items-center p-2 rounded-lg group {{ request()->routeIs('schedules.*') && !request()->routeIs('schedules.completed') ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    {{-- Icon Quản lý lịch học --}}
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                       <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z"/>
                       <path d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.638-6.639a2.961 2.961 0 0 1 4.188 4.188l-6.639 6.639a2.961 2.961 0 0 1-4.188-4.188Z"/>
                       <path d="M4.5 5.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"/>
                    </svg>
                    <span class="ms-3">Quản lý Lịch học</span>
                </a>
            </li>

            {{-- LỊCH SỬ LỊCH HỌC --}}
             <li>
                <a href="{{ route('schedules.completed') }}" class="flex items-center p-2 rounded-lg group {{ request()->routeIs('schedules.completed') ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                   {{-- Icon Lịch sử --}}
                   <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                   </svg>
                   <span class="ms-3">Lịch sử Lịch học</span>
                </a>
            </li>
        </ul>
    </div>
</aside>