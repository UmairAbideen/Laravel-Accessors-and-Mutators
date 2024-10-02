<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // fetch all employees data===================================================================================================================
    public function index()
    {
        // Check if the request is an AJAX request
        if(request()->ajax())
        {
            // Get the latest employees from the database
            $employees = Employee::latest()->get();

            // Return the employees data as a DataTable
            return datatables()->of($employees)
                    ->addColumn('action', function($employee) {
                        // Add edit and delete buttons to each employee row
                        return
                        '
                         <button type="button" class=" btn btn-info btn-sm w-25 text-white"
                         onClick="view(' . $employee->id . ')"    view-id="' . $employee->id . '"> View </button>

                         <button type="button" class=" btn btn-primary btn-sm mx-4 w-25"
                         onClick="edit(' . $employee->id . ')"    edit-id="' . $employee->id . '"> Edit </button>

                         <button type="button" class=" btn btn-danger btn-sm w-25"
                         onClick="destroy(' . $employee->id . ')"  delete-id="' . $employee->id . '">Delete</button>';
                    })
                    ->rawColumns(['action']) // Allow HTML in the 'action' column
                    ->make(true); // Create and return the DataTable
        }

        // If not an AJAX request, return the 'home' view
        return view('home');
    }


    // store an employee==========================================================================================================================
    public function create(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:30',
            'age' => 'required|numeric|max:100',
            'gender' => 'required|string|in:Male,Female,Other',
            'contact' => 'required|numeric|digits_between:11,13',
            'email' => 'required|email',
        ]);

        // Check if ID is provided in the request
        $employeeId = $request->id;

        // Update or create employee record
        Employee::updateOrCreate
        (
            [ // if $employeeId is null, it will create new record; otherwise, it will update existing record
                'id' => $employeeId
            ],
            [
                'name' => $request->name,
                'age' => $request->age,
                'gender' => $request->gender,
                'contact' => $request->contact,
                'email' => $request->email,
            ]
        );

        // Determine the response message based on whether $employeeId is null or not
        if ($employeeId) {
            // Update success response
            return response()->json(['success' => 'Employee has been updated successfully.']);
        } else {
            // Create success response
            return response()->json(['success' => 'New employee has been added successfully.']);
        }
    }


    // edit an employee============================================================================================================================
    public function edit(Request $request)
    {
        $employee = Employee::where('id',$request->id)->first();
        return response()->json($employee);
    }


    // delete an employee==========================================================================================================================
    public function delete(Request $request)
    {
        Employee::where('id', $request->id)->delete();
        return response()->json(['success' => 'Employee has been deleted successfully.']);
    }


    // single view ===============================================================================================================================
    public function view(Request $request)
    {
        $employee = Employee::where('id',$request->id)->first();
        return response()->json($employee);
    }


}
