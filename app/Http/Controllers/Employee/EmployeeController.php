<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // below the code for add the employee
    public function addEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'department' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'blood_group' => 'required|string|max:255',
        ]);

        $employee = [
            'name' => $request->name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'department' => $request->department,
            'contact_number' => $request->contact_number,
            'blood_group' => $request->blood_group
        ];

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $employee['image'] = $imageName;
        } elseif ($request->has('image')) {
            $imageData = $request->image;
            $imageExtension = explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
            $imageData = substr($imageData, strpos($imageData, ',') + 1);
            $imageData = base64_decode($imageData);
            $imageName = time() . '.' . $imageExtension;
            file_put_contents(public_path('images') . '/' . $imageName, $imageData);
            $employee['image'] = $imageName;
        }

        Employee::create($employee);

        return response()->json(['message' => 'Employee was SuccessFully Created']);
    }

    public function listAllEmployees()
    {
        $employees = Employee::all();
        return response()->json($employees, 200);
    }

    public function show(Request $request)
    {
        $id = $request->input('id');

        try {
            $employee = Employee::findOrFail($id);

            if ($employee instanceof Employee) {
                $employee->formattedCreatedAt = $employee->created_at->format('d M, Y');
                return $this->success('Successfully found employee.', $employee, 200);
            } else {
                return $this->error('Employee not found.', null, 404);
            }
        } catch (\Exception $e) {
            return $this->error('Employee not found', $e->getMessage(), 404);
        }
    }
}
