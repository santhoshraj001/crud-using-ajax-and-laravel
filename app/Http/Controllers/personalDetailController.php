<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class personalDetailController extends Controller
{
    //
    public function index(){
        return view('personal');
    }

    public function store (Request $request){
        //
        $skills = implode(',', $request->skills);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required',
            'place' => 'required',
            'gender' => 'required',
            'skills' => 'required|array'
          
        ]);
        // Process the validated data (e.g., save to database)
        DB::table('personal_table')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'place' => $request->place,
            'gender' => $request->gender,
            'skills' => $skills
           
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Personal details saved successfully! 👍'
        ]);

    }

    public function fetchdata(){
        $data = DB::table('personal_table')->get();
        return response()->json([
            'data' => $data
        ]);
    }
    public function edit($id){
        $data = DB::table('personal_table')->where('id', $id)->first();
        return response()->json([
            'data' => $data
        ]);
    }
    public function update(Request $request, $id){
        $skills = implode(',', $request->skills);
        DB::table('personal_table')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'place' => $request->place,
            'gender' => $request->gender,
            'skills' => $skills
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Personal details updated successfully!'
        ]);
    }
    public function delete($id){
        DB::table('personal_table')->where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Personal details deleted successfully!'
        ]);
    }

    public function deleteselected(Request $request){
        $ids = $request->ids; // Array of IDs to delete
        DB::table('personal_table')->whereIn('id', $ids)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Selected personal details deleted successfully!'
        ]);
    }

}
