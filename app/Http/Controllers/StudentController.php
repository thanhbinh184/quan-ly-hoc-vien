<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request; // QUAN TRỌNG: Đảm bảo có dòng này
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Hiển thị danh sách học viên (có chức năng tìm kiếm).
     */
    public function index(Request $request) // Thêm Request $request vào tham số
    {
        // 1. Bắt đầu câu truy vấn, chưa thực thi
        $query = Student::query();

        // 2. Kiểm tra xem có từ khóa tìm kiếm được gửi lên không
        if ($request->has('search') && $request->search != '') {
            // Thêm điều kiện WHERE vào câu truy vấn
            // Tìm kiếm gần đúng (LIKE %...%) trong cột 'full_name'
            $query->where('full_name', 'LIKE', '%' . $request->search . '%');
        }

        // 3. Thực thi câu truy vấn: sắp xếp, phân trang
        $students = $query->orderBy('full_name')->paginate(10);

        // 4. Nối các tham số tìm kiếm vào link phân trang
        $students->appends($request->only('search'));

        // 5. Trả về view với kết quả đã lọc và phân trang
        return view('students.index', compact('students'));
    }

    /**
     * Hiển thị form để tạo học viên mới.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Lưu trữ một học viên mới vào database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name'       => 'required|string|max:100',
            'avatar'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_of_birth'   => 'nullable|date',
            'phone_number'    => 'nullable|string|max:15',
            'address'         => 'nullable|string|max:255',
            'enrollment_date' => 'required|date',
            'status'          => 'required|string',
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $validatedData['avatar'] = $path;
        }

        Student::create($validatedData);

        return redirect()->route('students.index')->with('success', 'Thêm học viên mới thành công!');
    }

    /**
     * Hiển thị thông tin chi tiết của một học viên cụ thể.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Hiển thị form để chỉnh sửa thông tin học viên.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Cập nhật thông tin học viên trong database.
     */
    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'full_name'       => 'required|string|max:100',
            'avatar'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_of_birth'   => 'nullable|date',
            'phone_number'    => 'nullable|string|max:15',
            'address'         => 'nullable|string|max:255',
            'enrollment_date' => 'required|date',
            'status'          => 'required|string',
        ]);

        if ($request->hasFile('avatar')) {
            if ($student->avatar) {
                Storage::disk('public')->delete($student->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $validatedData['avatar'] = $path;
        }

        $student->update($validatedData);

        return redirect()->route('students.index')->with('success', 'Cập nhật thông tin học viên thành công!');
    }

    /**
     * Xóa một học viên khỏi database.
     */
    public function destroy(Student $student)
    {
        if ($student->avatar) {
            Storage::disk('public')->delete($student->avatar);
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Xóa học viên thành công!');
    }
}