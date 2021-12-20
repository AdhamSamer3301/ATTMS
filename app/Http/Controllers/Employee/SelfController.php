<?php

namespace App\Http\Controllers\Employee;

use App\Holiday;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SelfController extends Controller
{
    public function holidays() {
        $data = [
            'holidays' => Holiday::all()
        ];

        return view('employee.self.holidays')->with($data);
    }
        if ($request->hasFile('receipt')) {
            // GET FILENAME
            $filename_ext = $request->file('receipt')->getClientOriginalName();
            // GET FILENAME WITHOUT EXTENSION
            $filename = pathinfo($filename_ext, PATHINFO_FILENAME);
            // GET EXTENSION
            $ext = $request->file('receipt')->getClientOriginalExtension();
            //FILNAME TO STORE
            $filename_store = $filename.'_'.time().'.'.$ext;
            // UPLOAD IMAGE
            $path = $request->file('receipt')->storeAs('public/receipts', $filename_store);
            } else {
            $filename_store = 'noimg.jpg';
            }
        dd($path);
    }

    public function salary_slip() {
        return view('employee.self.salary');
    }
    public function salary_slip_print() {
        return view('employee.self.salary-print');
    }
}
