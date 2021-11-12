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
use App\Http\Resources\RequestResource;
use App\Models\Requests;

class RequestController extends Controller
{
    /**
     * Create a new RequestController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function index()
    {
        try {
            $resp = RequestResource::collection(Requests::all());
            return jsend_success($resp);
        } catch(\Exception $e) {
            return jsend_error($e);
        }
    }

    public function store(Request $request)
    {
        try {
            $resp = new RequestResource(Requests::create($request->all()));
            return jsend_success($resp);
        } catch(\Exception $e) {
            return jsend_error($e);
        }
    }
}
