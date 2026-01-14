<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Http\Requests\StoreInfoRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Responses\ApiResponses;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Exception;

class InfoController extends Controller
{
    public function index()
    {
        try {
            $info = Info::all();
            return ApiResponses::success($info, 'informacion usuario');
        } catch (\Exception $e) {
            return ApiResponses::error('Error en la base de datos', 500);
        }
    }

    public function create()
    {
        //
    }

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

            Info::create([
                'foto' => $nombre,
                'nacimiento' => $request->nacimiento,
                'matrimonio' => $request->matrimonio,
                'defuncion' => $request->defuncion,
                'impuesto' => $request->impuesto,
                'arbitrios' => $request->arbitrios,
                'titulo_propiedad' => $request->titulo_propiedad,
                'constancia_vivienda' => $request->constancia_vivienda,
                'multas' => $request->multas,
                'licencias' => $request->licencias,
            ]);

            return ApiResponses::success(null, 'Informacion registrada correctamente', 201);
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
    
    public function show($id)
    {
        try {
            $info = Info::where(['id' => $id])->firstOrFail();
            return ApiResponses::success('Mostrando la informacion del usuario', 200, $info);
        } catch (ModelNotFoundException $e) {
            return ApiResponses::error('Error no encontrado', 404);
        } catch (Exception $e) {
            return ApiResponses::error('Error en la base de datos', 500);
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $info = Info::where(['id' => $id])->firstOrFail();

            $request->validate([
                'nacimiento' => ['required', Rule::unique('nacimiento')->ignore($nacimiento)], 
                'matrimonio' => 'date', 
                'defuncion' => 'date',
                'impuesto' => 'integer',
                'arbitrios' => 'integer',
                'titulo_propiedad' => 'string',
                'constancia_vivienda' => 'string',
                'multas' => 'integer',
                'licencias' => 'string',
            ],
            [
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

        } catch (ModelNotFoundException $e) {
            return ApiResponses::error('Error no encontrado', 404);
        } catch (Exception $e) {
            return ApiResponses::error('Error en la base de datos', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $info = Info::where(['id' => $id])->firstOrFail();
            $info->delete();
            return ApiResponses::success(null, 'Informacion eliminada correctamente', 200);
        } catch (ModelNotFoundException $e) {
            return ApiResponses::error('Error no encontrado', 404);
        } catch (Exception $e) {
            return ApiResponses::error('Error en la base de datos', 500);
        }
    }
}
