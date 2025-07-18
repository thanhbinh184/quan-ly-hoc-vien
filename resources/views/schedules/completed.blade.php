<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lịch sử Lịch học (Đã hoàn thành / Đã hủy)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
                                @forelse ($completedSchedules as $schedule)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $schedule->student->full_name }}
                                        </th>
                                        <td class="px-6 py-4">{{ $schedule->lesson_type }}</td>
                                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($schedule->lesson_date)->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                                        <td class="px-6 py-4">
                                            @if ($schedule->status == 'Hoàn thành')
                                                <span class="font-semibold text-green-600">{{ $schedule->status }}</span>
                                            @else
                                                <span class="font-semibold text-red-600">{{ $schedule->status }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            {{-- Có thể thêm nút "Xem chi tiết" hoặc "Khôi phục" ở đây sau --}}
                                            <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn lịch học này không?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Xóa vĩnh viễn</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800">
                                        <td colspan="6" class="px-6 py-4 text-center">Chưa có lịch học nào đã hoàn thành hoặc bị hủy.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     <div class="mt-4">
                        {{ $completedSchedules->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>