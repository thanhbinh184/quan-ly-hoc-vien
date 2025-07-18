<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Chi tiết Học viên: {{ $student->full_name }}
            </h2>
            <a href="{{ route('students.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5">
                ← Quay lại danh sách
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- === BẮT ĐẦU SỬA CẤU TRÚC === --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        
                        {{-- CỘT 1: AVATAR --}}
                        <div class="md:col-span-1">
                            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Ảnh đại diện</h3>
                            @if ($student->avatar)
                                <img src="{{ asset('storage/' . $student->avatar) }}" alt="Avatar của {{ $student->full_name }}" class="w-40 h-52 object-cover rounded-lg shadow-md">
                            @else
                                {{-- Ảnh mặc định nếu không có avatar --}}
                                <div class="w-40 h-52 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Chưa có ảnh</p>
                            @endif
                        </div>

                        {{-- CỘT 2 & 3: THÔNG TIN CHI TIẾT --}}
                        <div class="md:col-span-2 space-y-6">
                            {{-- Nhóm thông tin cá nhân --}}
                            <div>
                                <h3 class="text-lg font-semibold border-b pb-2 mb-4 text-gray-900 dark:text-white">Thông tin cá nhân</h3>
                                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Họ và Tên</dt>
                                        <dd class="mt-1 text-md dark:text-white">{{ $student->full_name }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Ngày sinh</dt>
                                        <dd class="mt-1 text-md dark:text-white">{{ \Carbon\Carbon::parse($student->date_of_birth)->format('d/m/Y') }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Số điện thoại</dt>
                                        <dd class="mt-1 text-md dark:text-white">{{ $student->phone_number }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Địa chỉ</dt>
                                        <dd class="mt-1 text-md dark:text-white">{{ $student->address }}</dd>
                                    </div>
                                </dl>
                            </div>

                            {{-- Nhóm thông tin khóa học --}}
                            <div>
                                <h3 class="text-lg font-semibold border-b pb-2 mb-4 text-gray-900 dark:text-white">Thông tin khóa học</h3>
                                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Ngày đăng ký</dt>
                                        <dd class="mt-1 text-md dark:text-white">{{ \Carbon\Carbon::parse($student->enrollment_date)->format('d/m/Y') }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Trạng thái</dt>
                                        <dd class="mt-1 text-md">
                                            {{-- Code hiển thị status giữ nguyên --}}
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                    {{-- === KẾT THÚC SỬA CẤU TRÚC === --}}
                </div>

                {{-- Nút hành động ở cuối trang --}}
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 flex justify-end">
                    <a href="{{ route('students.edit', $student->id) }}" class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Chỉnh sửa
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>