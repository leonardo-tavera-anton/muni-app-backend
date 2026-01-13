<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Http\Requests\StoreInfoRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Responses\ApiResponses; //novo
use iluminate\Http\validationException; //novo
use Exception; //novo

class InfoController extends Controller
{
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
        try{
            $request->validate([
                'dni' => 'required|unique|max:10',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nacimiento' => 'required|integer|min:1', // coherencia
                'matrimonio' => 'required|integer|min:1', // coherencia
                'direccion' => 'required|string|max:500',
                'telefono' => 'required|string|max:20',
            ],
            [
                // requerimientos personalizados
                'nombre.unique' => 'nombre ya en uso',
                'apellido.unique' => 'apellido ya en uso',
                'edad.integer' => 'edad debe ser un numero entero',
                'telefono.max' => 'telefono debe tener maximo 20 caracteres',
            ]);

            $f = $request->file('foto');
            $nombre = time().'_'.$f->getClientOriginalName(); // llamada al nombre

            $f->move(public_path().'/logos/', $nombre); // mover a la carpeta public/logos
        }
            catch (ValidationException $e) {
                return ApiResponses::error('Datos de entrada no validos', 422, $e->errors());
            } catch (Exception $e) {
                return ApiResponses::error('Error al procesar la solicitud', 500);
        }
            catch (Exception $e) {
                return ApiResponses::error('Error de validacion', 401);   
        }

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
