<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function getall()
    {
        return Student::all();
    }
    public function get(Request $req)
    {
        $st = Student::where('id', $req->id)->first();
        if ($st) {
            return response()->json($st, 200);
        }
        return response()->json(["msg" => "notfound"], 404);
    }
    public function delete(Request $req)
    {
        $std = Student::where('id', $req->id)->first();
        // $std->delete();
        if ($std->delete()) {
            return response()->json(["msg" => "Delete Succesfull"], 200);
        }
        return response()->json(["msg" => "notfound"], 404);
    }
    public function add(Request $req)
    {
        try {
            $st = new  Student;
            $st->name = $req->name;
            $st->email = $req->email;
            $st->sid = $req->sid;
            if ($st->save()) {

                return response()->json(["msg" => "Added Successfully"], 200);
            }
        } catch (\Exception $ex) {
            return response()->json(["errormsg" => "Could not add"], 500);
        }
    }
    // edit
    public function edit(Request $req)
    {
        try {
            $st = Student::where('id', $req->id)->first();
            $st->name = $req->name;
            $st->email = $req->email;
            $st->sid = $req->sid;
            if ($st->update()) {
                return redirect('http://localhost:3000/allstudent');
                // return response()->json(["msg" => "Added Successfully"], 200);
            }
        } catch (\Exception $ex) {
            return response()->json(["errormsg" => "Could not add"], 500);
        }
    }
    //
}
