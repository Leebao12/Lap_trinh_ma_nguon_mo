<?php


namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = [
            ['name' => 'Nguyễn Thế Anh', 'age' => 20, 'email' => 'nguyentheanh@huit.edu.vn'],
            ['name' => 'Trần Bảo Anh', 'age' => 20, 'email' => 'tranbaoanh@huit.edu.vn'],
            ['name' => 'Lê Quang Bảo', 'age' => 19, 'email' => 'lequangbao@huit.edu.vn'],
            ['name' => 'Trần Dương Gia Bảo', 'age' => 20, 'email' => 'tranduonggiabao@huit.edu.vn'],
            ['name' => 'Trần Gia Bảo', 'age' => 20, 'email' => 'trangiabao@huit.edu.vn'],
            ['name' => 'Ngọc Châu', 'age' => 19, 'email' => 'ngocchau@huit.edu.vn'],
        ];

        return view('students.index', compact('students'));
    }
    /*public function indexDb()
    {
        $students = Student::orderBy('id', 'desc')->paginate(5);
        return view('students.index_db', compact('students'));
    }*/
    public function indexDb()
    {
        $gender = request('gender'); // 'male' | 'female' | null
        $query = \App\Models\Student::query()->orderBy('id', 'desc');
        if ($gender) {
            $query->where('gender', $gender);
        }
        $students = $query->paginate(5)->appends(compact('gender'));
        return view('students.index_db', compact('students', 'gender'));
    }

    public function combined()
    {
        $static = [
            [
                'name' => 'Nguyễn An',
                'age' => 19,
                'email' => 'an@huit.edu.vn',
                'gender' => 'male'
            ],
            [
                'name' => 'Trần Bình',
                'age' => 18,
                'email' => 'binh@huit.edu.vn',
                'gender' => 'male'
            ],
            [
                'name' => 'Lê Chi',
                'age' => 17,
                'email' => 'chi@huit.edu.vn',
                'gender' => 'female'
            ],
        ];
        $db = \App\Models\Student::orderBy('id', 'desc')->paginate(5);

        $source = request('source', 'db');
        return view('students.combined', compact('static', 'db', 'source'));
    }
    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students,email',
            'age' => 'nullable|integer|min:16',
            'gender' => 'nullable|in:male,female',
        ]);

        Student::create($validated);

        return redirect('/students/db')
            ->with('success', 'Tạo mới thành công');
    }
}
