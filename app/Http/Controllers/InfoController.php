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
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nacimiento' => 'required|date', 
                'matrimonio' => 'required|date', 
                'defuncion' => 'required|date',
                'impuesto' => 'required|integer',
                'arbitrios' => 'required|integer',
                'titulo_propiedad' => 'required|string',
                'constancia_vivienda' => 'required|string',
                'multas' => 'required|integer',
                'licencias' => 'required|string',
            ],
            [
                // mensajes de error personalizados
                'foto.image' => 'archivo debe ser una imagen valida',
                'nacimiento.date' => 'fecha de nacimiento invalida',
                'matrimonio.date' => 'fecha de matrimonio invalida',
                'defuncion.date' => 'fecha de defuncion invalida',
                'impuesto.integer' => 'impuesto debe ser un numero entero',
                'arbitrios.integer' => 'arbitrios debe ser un numero entero',
                'titulo_propiedad.string' => 'titulo de propiedad debe ser una cadena de texto',
                'constancia_vivienda.string' => 'constancia de vivienda debe ser una cadena de texto',
                'multas.integer' => 'multas debe ser un numero entero',
                'licencias.string' => 'licencias debe ser una cadena de texto',
            ]);
            
            // por foto unica
            $f = $request->file('foto');
            $nombre = time().'_'.$f->getClientOriginalName(); // llamada al nombre

            $f->move(public_path().'/foto/', $nombre); // mover a la carpeta public/foto
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
