<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Http\Requests\StoreInfoRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Responses\ApiResponses; //novo
use Exception; //novo

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** obtiene toda la informacion del error*/
        try {
            $info = Info::all();
            return ApiResponses::success($info, 'informacion usuario');
        } catch (\Exception $e) {
            return ApiResponses::error('Error al obtener la informacion en la base de datos', 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInfoRequest $request)
    {
        // guarda la informacion del usuario
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Info $info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Info $info)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInfoRequest $request, Info $info)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Info $info)
    {
        //
    }
}
