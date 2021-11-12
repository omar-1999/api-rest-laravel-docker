<?php

/**
 * 2021-10-10
 * @author Omar Sinisterra <omarsinisterra-1999@outlook.es>
 * @return \Illuminate\Http\Response
 * @Descripcion:
 * Controlador para la gestion de los empleados
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Create a new EmployeesController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function index()
    {
        try {
            $employees = EmployeeResource::collection(Employee::all());
            return jsend_success($employees);
        } catch(\Exception $e) {
            return jsend_error($e);
        }
    }

    public function store(Request $request)
    {
        try {
            $employee = new EmployeeResource(Employee::create($request->all()));
            return jsend_success($employee);
        } catch(\Exception $e) {
            return jsend_error($e);
        }
    }

    public function show($id)
    {
        try {
            $employee = new EmployeeResource(Employee::findOrFail($id));
            return jsend_success($employee);
        } catch(\Exception $e) {
            return jsend_error($e);
        }
    }
}
