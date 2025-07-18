<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tạo lịch học mới
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                
                {{-- Hiển thị lỗi validate nếu có --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>- {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('schedules.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Cột 1 --}}
                        <div>
                            <!-- Chọn Học viên -->
                            <div class="mb-4">
                                <label for="student_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Chọn Học viên <span class="text-red-500">*</span></label>
                                <select id="student_id" name="student_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                    <option value="">-- Chọn một học viên --</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                            {{ $student->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Loại buổi học -->
                            <div class="mb-4">
                                <label for="lesson_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Loại buổi học <span class="text-red-500">*</span></label>
                                <input type="text" id="lesson_type" name="lesson_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Ví dụ: Sa hình, Đường trường" required value="{{ old('lesson_type') }}">
                            </div>

                            <!-- Ngày học -->
                            <div class="mb-4">
                                <label for="lesson_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ngày học <span class="text-red-500">*</span></label>
                                <input type="date" id="lesson_date" name="lesson_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="{{ old('lesson_date', date('Y-m-d')) }}">
                            </div>
                        </div>

                        {{-- Cột 2 --}}
                        <div>
                             <!-- Giờ bắt đầu -->
                            <div class="mb-4">
                                <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Giờ bắt đầu <span class="text-red-500">*</span></label>
                                <input type="time" id="start_time" name="start_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="{{ old('start_time') }}">
                            </div>

                            <!-- Giờ kết thúc -->
                            <div class="mb-4">
                                <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Giờ kết thúc <span class="text-red-500">*</span></label>
                                <input type="time" id="end_time" name="end_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="{{ old('end_time') }}">
                            </div>

                             <!-- Trạng thái -->
                            <div class="mb-4">
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Trạng thái</label>
                                <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                    <option value="Đã đặt" selected>Đã đặt</option>
                                    <option value="Hoàn thành">Hoàn thành</option>
                                    <option value="Đã hủy">Đã hủy</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Nút bấm --}}
                    <div class="flex justify-end mt-6">
                        <a href="{{ route('schedules.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2">Hủy</a>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Lưu lịch học</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>