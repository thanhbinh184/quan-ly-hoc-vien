<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Chỉnh sửa thông tin: {{ $student->full_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>- {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        
                        {{-- CỘT 1: Dành riêng cho AVATAR --}}
                        <div class="md:col-span-1">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ảnh đại diện</label>
                            
                            {{-- SỬA 1: Khởi tạo imagePreview với ảnh hiện tại --}}
                            <div x-data="{ imagePreview: '{{ $student->avatar ? asset('storage/' . $student->avatar) : null }}' }" class="mt-2">
                                <!-- Vùng xem trước ảnh -->
                                <div class="w-40 h-52 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-4">
                                    {{-- Hiển thị placeholder nếu không có ảnh --}}
                                    <template x-if="!imagePreview">
                                        <span class="text-gray-400">Chưa có ảnh</span>
                                    </template>
                                    {{-- Hiển thị ảnh (cũ hoặc mới) --}}
                                    <template x-if="imagePreview">
                                        <img :src="imagePreview" class="w-40 h-52 object-cover rounded-lg">
                                    </template>
                                </div>
                                <!-- Nút upload -->
                                <label for="avatar" class="cursor-pointer text-sm text-blue-600 dark:text-blue-500 hover:underline">
                                    Chọn ảnh mới để thay đổi
                                </label>
                                <input type="file" id="avatar" name="avatar" class="hidden" @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                                <p class="mt-1 text-xs text-gray-500">Để trống nếu không muốn thay đổi.</p>
                            </div>
                        </div>

                        {{-- CỘT 2 & 3: Dành cho thông tin --}}
                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Cột thông tin 1 --}}
                            <div>
                                <!-- Họ và Tên -->
                                <div class="mb-4">
                                    <label for="full_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Họ và Tên <span class="text-red-500">*</span></label>
                                    <input type="text" id="full_name" name="full_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="{{ old('full_name', $student->full_name) }}">
                                </div>

                                <!-- Ngày sinh -->
                                <div class="mb-4">
                                    <label for="date_of_birth" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ngày sinh</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" value="{{ old('date_of_birth', $student->date_of_birth) }}">
                                </div>

                                <!-- Số điện thoại -->
                                <div class="mb-4">
                                    <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Số điện thoại</label>
                                    <input type="tel" id="phone_number" name="phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" value="{{ old('phone_number', $student->phone_number) }}">
                                </div>
                            </div>
                            
                            {{-- Cột thông tin 2 --}}
                            <div>
                                <!-- Địa chỉ -->
                                <div class="mb-4">
                                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Địa chỉ</label>
                                    <input type="text" id="address" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" value="{{ old('address', $student->address) }}">
                                </div>

                                <!-- Ngày đăng ký -->
                                <div class="mb-4">
                                    <label for="enrollment_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ngày đăng ký <span class="text-red-500">*</span></label>
                                    <input type="date" id="enrollment_date" name="enrollment_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required value="{{ old('enrollment_date', $student->enrollment_date) }}">
                                </div>

                                <!-- Trạng thái -->
                                <div class="mb-4">
                                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Trạng thái</label>
                                    <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                        <option value="Đang học" @selected(old('status', $student->status) == 'Đang học')>Đang học</option>
                                        <option value="Tạm dừng" @selected(old('status', $student->status) == 'Tạm dừng')>Tạm dừng</option>
                                        <option value="Đã tốt nghiệp" @selected(old('status', $student->status) == 'Đã tốt nghiệp')>Đã tốt nghiệp</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Nút bấm --}}
                    <div class="flex justify-end mt-8 border-t pt-6">
                        <a href="{{ route('students.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2">Hủy</a>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>