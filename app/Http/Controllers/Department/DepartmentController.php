<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Below the code for create the departments
     * 
     */
    public function createDepartment(Request $request)
    {
        $departmentName = $request->name;

        $department = Department::create([
            'name' => $departmentName,
        ]);

        return response()->json(['messge' => 'Department is Created']);
    }


    function listAllDepartments()
    {
        $departments = Department::get();
        foreach ($departments as $department) {
            $department->formattedCreatedAt = $department->created_at->format('d M, Y');
        }
        return $departments;
    }

    public function departmentDropdown()
    {
        try {
            $departments = Department::orderBy('id')->pluck('name', 'id')->toArray();
            return $this->success('Department names fetched successfully', $departments, 200);
        } catch (\Exception $e) {
            return $this->error('', $e->getMessage(), 500);
        }
    }
}
