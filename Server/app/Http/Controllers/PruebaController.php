<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Prueba;
use App\Models\Eleccion;
use App\Models\Valoracion;
use App\Models\Puntual;
use App\Models\RespLibre;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\UsuariosAsignados;
class PruebaController extends Controller
{

    public function insertPrueba($req)
    {

        $input = $req->all();

        $messages = [
            'max' => 'excede del tamaño máximo :max',
        ];

        $validator = Validator::make($input, [
            'destino' => 'required|int|max:100',
            'tipo' => 'required|string|max:255',
            'pregunta' => 'required|string|max:255'
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $datos = [
            'destino' => $req->destino,
            'iddios' => $req->iddios,
            'tipo' => $req->tipo,
            'pregunta' => $req->pregunta,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $prueba = Prueba::create($datos);
        if ($prueba) {
            return $prueba;
        } else {
            return false;
        }
    }

    public function insertPruebaEleccion(Request $req)
    {

        $input = $req->all();

        if ($prueba = PruebaController::insertPrueba($req)) {
            $messages = [
                'max' => 'excede del tamaño máximo :max',
            ];

            $validator = Validator::make($input, [
                'correcta' => 'required|string|max:255',
                'incorrecta' => 'required|string|max:255',
                'habilidad' => 'required|string|max:255',
            ], $messages);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $datos = [
                'idprueba' => $prueba->id,
                'correcta' => $req->correcta,
                'incorrecta' => $req->incorrecta,
                'habilidad' => $req->habilidad,
            ];

            $eleccion = Eleccion::create($datos);
            if ($eleccion) {
                return response()->json($mensaje = "Prueba creada con éxito", 200);
            } else {
                Prueba::destroy($prueba->id);
            }
        }
        return response()->json($mensaje = "No se consiguio registrar la prueba", 202);
    }

    public function insertPruebaValoracion(Request $req)
    {

        $input = $req->all();

        if ($prueba = PruebaController::insertPrueba($req)) {
            $messages = [
                'max' => 'excede del tamaño máximo :max',
            ];

            $validator = Validator::make($input, [
                'habilidad' => 'required|string|max:255',
            ], $messages);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $datos = [
                'idprueba' => $prueba->id,
                'habilidad' => $req->habilidad,
            ];

            $valoracion = Valoracion::create($datos);
            if ($valoracion) {
                return response()->json($mensaje = "Prueba creada con éxito", 200);
            } else {
                Prueba::destroy($prueba->id);
            }
        }
        return response()->json($mensaje = "No se consiguio registrar la prueba", 202);

    }

    public function insertPruebaPuntual(Request $req)
    {

        $input = $req->all();

        if ($prueba = PruebaController::insertPrueba($req)) {
            $messages = [
                'max' => 'excede del tamaño máximo :max',
            ];

            $validator = Validator::make($input, [
                'habilidad' => 'required|string|max:255',
                'porcentaje' => 'required|int|max:100',
            ], $messages);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $datos = [
                'idprueba' => $prueba->id,
                'habilidad' => $req->habilidad,
                'porcentaje' => $req->porcentaje,
            ];

            $puntual = Puntual::create($datos);
            if ($puntual) {
                return response()->json($mensaje = "Prueba creada con éxito", 200);
            } else {
                Prueba::destroy($prueba->id);
            }
        }
        return response()->json($mensaje = "No se consiguio registrar la prueba", 202);

    }

    public function insertPruebaRespLibre(Request $req)
    {

        $input = $req->all();

        if ($prueba = PruebaController::insertPrueba($req)) {
            $messages = [
                'max' => 'excede del tamaño máximo :max',
            ];

            $validator = Validator::make($input, [
                'palabrasclaves' => 'required|string|max:255',
                'porcentaje' => 'required|int|max:100',
            ], $messages);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $datos = [
                'idprueba' => $prueba->id,
                'palabrasclaves' => $req->palabrasclaves,
                'porcentaje' => $req->porcentaje,
            ];

            $libre = RespLibre::create($datos);
            if ($libre) {
                return response()->json($mensaje = "Prueba creada con éxito", 200);
            } else {
                Prueba::destroy($prueba->id);
            }
        }
        return response()->json($mensaje = "No se consiguio registrar la prueba", 202);
    }

    public function getPruebas()
    { {
            $prueba = [
                PruebaController::getPruebasValoracion(),
                PruebaController::getPruebasEleccion(),
                PruebaController::getPruebasRespLibre(),
                PruebaController::getPruebasPuntual()
            ];
            return response()->json($prueba, 200);
        }
    }

    public function getPruebasValoracion()
    {
        $valoracion = Prueba::with(['pruebaValoracion'])
            ->where('tipo', 'Valoracion')
            ->get();
        return $valoracion;
    }

    public function getPruebasEleccion()
    {
        $eleccion = Prueba::with(['pruebaEleccion'])
            ->where('tipo', 'Eleccion')
            ->get();
        return $eleccion;
    }

    public function getPruebasRespLibre()
    {
        $libre = Prueba::with(['pruebaRespLibre'])
            ->where('tipo', 'Respuesta Libre')
            ->get();
        return $libre;
    }

    public function getPruebasPuntual()
    {
        $puntual = Prueba::with(['pruebaPuntual'])
            ->where('tipo', 'Puntual')
            ->get();
        return $puntual;
    }

    public function deletePrueba($id)
    {

        $prueba = Prueba::find($id);
        if ($prueba) {
            $prueba->delete();
            return response()->json($mensaje = "Borrado con éxito", 200);
        } else {
            return response()->json($mensaje = "No se pudo borrar", 202);
        }
    }


    public function getPruebasUser($id)
    {
        $idprueba=UsuariosAsignados::select(['idprueba','idusuario'])
            ->where('idusuario', $id)
            ->get();
        $prueba = Prueba::select(['id', 'destino', 'iddios', 'tipo', 'pregunta'])
            ->where('id', $idprueba)
            ->get()->toArray();
        return response()->json($idprueba, 200);
    }
}
