{{-- File: resources/views/schedules/edit.blade.php (PHIÊN BẢN HOÀN CHỈNH) --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Chỉnh sửa Lịch học
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">

                {{-- Khối hiển thị lỗi validation --}}
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                        <p class="font-bold">Oops! Có lỗi xảy ra:</p>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Chọn học viên --}}
                        <div class="mb-4 md:col-span-2">
                            <label for="student_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Học viên <span class="text-red-500">*</span></label>
                            <select id="student_id" name="student_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}" @selected(old('student_id', $schedule->student_id) == $student->id)>
                                        {{ $student->full_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Loại buổi học --}}
                        <div class="mb-4">
                            <label for="lesson_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loại buổi học <span class="text-red-500">*</span></label>
                            <input type="text" id="lesson_type" name="lesson_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required value="{{ old('lesson_type', $schedule->lesson_type) }}">
                        </div>

                        {{-- Ngày học --}}
                        <div class="mb-4">
                             <label for="lesson_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ngày học <span class="text-red-500">*</span></label>
                            <input type="date" id="lesson_date" name="lesson_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required value="{{ old('lesson_date', $schedule->lesson_date) }}">
                        </div>

                         {{-- Thời gian bắt đầu --}}
                        <div class="mb-4">
                            <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Giờ bắt đầu <span class="text-red-500">*</span></label>
                            <input type="time" id="start_time" name="start_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required value="{{ old('start_time', $schedule->start_time) }}">
                        </div>

                        {{-- Thời gian kết thúc --}}
                        <div class="mb-4">
                            <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Giờ kết thúc <span class="text-red-500">*</span></label>
                            <input type="time" id="end_time" name="end_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required value="{{ old('end_time', $schedule->end_time) }}">
                        </div>

                         {{-- Trạng thái --}}
                        <div class="mb-4">
                             <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Trạng thái</label>
                            <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="Đã đặt" @selected(old('status', $schedule->status) == 'Đã đặt')>Đã đặt</option>
                                <option value="Hoàn thành" @selected(old('status', $schedule->status) == 'Hoàn thành')>Hoàn thành</option>
                                <option value="Đã hủy" @selected(old('status', $schedule->status) == 'Đã hủy')>Đã hủy</option>
                            </select>
                        </div>
                    </div>

                    {{-- Ghi chú --}}
                    <div class="mt-4">
                        <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ghi chú</label>
                        <textarea id="notes" name="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ old('notes', $schedule->notes) }}</textarea>
                    </div>

                    {{-- Nút bấm --}}
                    <div class="flex justify-end mt-6">
                        <a href="{{ route('schedules.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Hủy</a>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Cập nhật</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>