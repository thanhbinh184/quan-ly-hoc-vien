<x-app-layout>
    {{-- Header chỉ chứa tiêu đề --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Quản lý Lịch học
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- === BẮT ĐẦU SỬA === --}}
            {{-- Đặt nút Thêm mới ở đây, ngay trên đầu bảng --}}
            <div class="flex justify-end mb-4">
                <a href="{{ route('schedules.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Thêm Lịch học mới
                </a>
            </div>
            {{-- === KẾT THÚC SỬA === --}}


            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            {{-- ... Nội dung bảng giữ nguyên ... --}}
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Học viên</th>
                                    <th scope="col" class="px-6 py-3">Loại buổi học</th>
                                    <th scope="col" class="px-6 py-3">Ngày học</th>
                                    <th scope="col" class="px-6 py-3">Thời gian</th>
                                    <th scope="col" class="px-6 py-3">Trạng thái</th>
                                    <th scope="col" class="px-6 py-3 text-right">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($schedules as $schedule)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $schedule->student->full_name }}
                                        </th>
                                        <td class="px-6 py-4">{{ $schedule->lesson_type }}</td>
                                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($schedule->lesson_date)->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                                        <td class="px-6 py-4">
                                            {{-- ... code hiển thị status giữ nguyên ... --}}
                                        </td>
                                        <td class="px-6 py-4 text-right flex items-center justify-end gap-x-4">
                                        <a href="{{ route('schedules.edit', $schedule->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Sửa</a>
                                        <form action="{{ route('schedules.complete', $schedule->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="font-medium text-green-600 dark:text-green-500 hover:underline">Hoàn thành</button>
                                        </form>
                                        <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn lịch học này không?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Xóa</button>
                                        </form>
                                    </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800">
                                        <td colspan="6" class="px-6 py-4 text-center">Chưa có lịch học nào.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     <div class="mt-4">
                        {{ $schedules->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>