<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Quản lý Học viên') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                {{-- Phần Header của bảng --}}
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        {{-- FORM TÌM KIẾM --}}
                        <form class="flex items-center" method="GET" action="{{ route('students.index') }}">
                            <label for="simple-search" class="sr-only">Tìm kiếm học viên</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search" name="search" value="{{ request('search') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Gõ tên học viên và nhấn Enter...">
                            </div>
                        </form>
                    </div>
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        {{-- NÚT THÊM MỚI --}}
                        <a href="{{ route('students.create') }}" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"><path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" /></svg>
                            Thêm học viên mới
                        </a>
                    </div>
                </div>

                {{-- Phần Bảng dữ liệu --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Ảnh</th>
                                <th scope="col" class="px-4 py-3">Họ và Tên</th>
                                <th scope="col" class="px-4 py-3">Số điện thoại</th>
                                <th scope="col" class="px-4 py-3">Trạng thái</th>
                                <th scope="col" class="px-4 py-3 text-right">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-2">
                                        @if ($student->avatar)
                                            <img src="{{ asset('storage/' . $student->avatar) }}" alt="Avatar" class="h-10 w-10 object-cover rounded-full">
                                        @else
                                            <span class="inline-block h-10 w-10 rounded-full overflow-hidden bg-gray-100"><svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg></span>
                                        @endif
                                    </td>
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $student->full_name }}</th>
                                    <td class="px-4 py-3">{{ $student->phone_number }}</td>
                                    <td class="px-4 py-3">
                                        @if ($student->status == 'Đang học')
                                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ $student->status }}</span>
                                        @elseif ($student->status == 'Tạm dừng')
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ $student->status }}</span>
                                        @else
                                            <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $student->status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <a href="{{ route('students.show', $student->id) }}" class="text-blue-500 hover:text-blue-700 font-bold mr-4">Xem</a>
                                        <a href="{{ route('students.edit', $student->id) }}" class="text-yellow-500 hover:text-yellow-700 font-bold">Sửa</a>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa học viên này không? Thao tác này không thể hoàn tác.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ml-4 text-red-500 hover:text-red-700 font-bold">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-b dark:border-gray-700">
                                    <td colspan="5" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                        Không tìm thấy học viên nào khớp với từ khóa của bạn.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Phần Phân trang --}}
                <div class="p-4">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>