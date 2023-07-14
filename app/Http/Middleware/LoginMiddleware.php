<?php

namespace App\Http\Middleware;

use Closure;
use App\Employee;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|integer|max:999999',
            'password' => 'required',

        ]);

        $employee_id = $request->emp_id;
        $password = $request->password;

        $query = Employee::where('employee_id', $employee_id)
            ->where('password', $password)
            ->first();
        Log::info($query);

        if ($validator->fails()) {
            return redirect()->route('pages.login')->withErrors($validator->errors());

            // foreach ($query as $employee) {
            //     if (Hash::check($password, $employee->password)) {
            //     } else {
            //         return redirect()->route('pages.login')->with("fail", "Invalid password!");
            //     }
            // }
        }


        foreach ($query as $employee) {
            if ($employee_id == $employee->emp_id  && Hash::check($password, $employee->password)) {
                return $next($request);
            }
        }
    }
}
