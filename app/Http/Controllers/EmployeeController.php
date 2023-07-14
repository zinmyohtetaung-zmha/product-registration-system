<?php

namespace App\Http\Controllers;

use App\Model\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginCheckRequest;


/**
 * Employee Controller Class
 * @author ZinMyoHtetAung
 * @create 06/22/2023
 * @param
 * @return 
 */
class EmployeeController extends Controller
{
    /**
     * Check employee id and password from employees DB
     * @author ZinMyoHtetAung
     * @create 06/21/2023
     * @param  Request  $formData
     * @return void
     */
    public function checkEmployee(LoginCheckRequest $request)
    {

        $employee_id = $request->employee_id;
        $password = $request->password;

        $employee = Employee::where('emp_id', $employee_id)->first();

        if ($employee && Hash::check($password, $employee->password)) {
            return redirect()->route('item.lists');
        } else {
            return redirect()->back()->with('fail', 'Invalid employee ID or password.');
        }
    }
}
