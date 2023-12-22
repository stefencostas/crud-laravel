<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        // return view('students.index', ['students' => $students]);
        return Student::all();
    }

    public function add()
    {
        //return view('students.add');
    }

    public function store(Request $request)
    {
        try
        {
            $student = new Student;
            $student->name = $request->name;
            $student->grade = $request->grade;

            $student->save();

            return response()->json(["message"=>"successfully added student."], 201);
        }

        catch(\Exception $e)
        {
            return response()->json(["message"=>$e->getMessage()], 500);
        }
    }

    public function edit(Student $student)
    {
        //return view('students.edit', ['student' => $student]);
    }

    public function update(Request $request, $id)
    {
        try {
            $student = Student::find($id);

            if (!$student) {
                return response()->json(["message" => "Student not found"], 404);
            }

            $student->name = $request->name;
            $student->grade = $request->grade;

            $student->save();

            return response()->json(["message" => "Successfully updated student."], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            $student = Student::find($id);

            if (!$student) {
                return response()->json(["message" => "Student not found"], 404);
            }

            $student->delete();

            return response()->json(["message" => "Successfully deleted student."], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }
}
