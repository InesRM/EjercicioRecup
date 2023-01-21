<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HumanData;
use App\Models\AtributesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\VerificationMail;
use App\Models\Atributes;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Random;

class AuthController extends Controller {
    public function register(Request $request){
        $messages = [
            'email' => 'El campo no se ajusta a un correo estándar',
            'same' => 'Los campos :password y :confirm_password deben coincidir.',
            'max' => 'El campo se excede del tamaño máximo :max',
            'between' => 'El valor del campo :edad no está entre :18,100',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'edad' => 'numeric|between:18,100'
        ],$messages);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }


        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['role'] = "human";
        $user = User::create($input);
        $success['token'] = $user->createToken('token'.$user['id'], ["read","create"])->plainTextToken;
        $success['name'] = $user->name;
        VerificationMail::sendMail($user->email, $user->name);
        $dataH = [
            'ID' => $user->id,
            'destino' => 0,
            'protection' => random_int(1, 3)
        ];
        $humanData = HumanData::create($dataH);
        $cont = 1;
        while ($cont <= 5) {
            $dataA = [
                'atributeID' => $cont,
                'userID' => $user->id,
                'value' => random_int(1, 5),
                'created_at' => now(),
                'updated_at' => now()
            ];
            $atributesData = AtributesUsers::create($dataA);
            $cont++;
        }
        redirect('api');
        return response()->json(["success"=>true,"data"=>$success, "message" => "User successfully registered!"],200);
    }

    public function login(Request $request){
         if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $auth = Auth::user();
            if ($auth->email_verified_at != null){
                switch ($auth->role) {
                    case 'human':
                        $success['token'] = $auth->createToken('token'.$auth->id, ["read","create"])->plainTextToken;
                        $success['id'] = $auth->id;
                        $success['name'] = $auth->name;
                        $success['role'] = $auth->role;
                        $success['password'] = $auth->password;
                        $success['avatar'] = $auth->avatar;
                        $success['email'] = $auth->email;
                        $atribute = AtributesUsers::with(['atributos2'])->where('userID', $auth->id)->get();
                        $destino = HumanData::where('ID', $auth->id)->get('destino');
                        $protection = HumanData::where('ID', $auth->id)->get('protection');
                        $success['destino'] = $destino[0]->destino;
                        $success['protection'] = $protection[0]->protection;
                        $atributes = [];
                        foreach ($atribute as $atr) {
                            array_push($atributes, [
                                "name" => $atr->atributos2[0]->name,
                                "value" => $atr->value
                            ]);
                        }
                        $success['attributes'] = $atributes;
                        return response()->json(["success"=>true,"data"=>$success, "message" => "Logged in!"],200);


                    case 'god':
                        $success['token'] = $auth->createToken('token'.$auth->id, ["read","delete","create"])->plainTextToken;
                        $success['id'] = $auth->id;
                        $success['name'] = $auth->name;
                        $success['role'] = $auth->role;
                        $success['password'] = $auth->password;
                        $success['avatar'] = $auth->avatar;
                        $success['email'] = $auth->email;
                        $atribute = AtributesUsers::with(['atributos2'])->where('userID', $auth->id)->get();
                        $atributes = [];
                        foreach ($atribute as $atr) {
                            array_push($atributes, [
                                "name" => $atr->atributos2[0]->name,
                                "value" => $atr->value
                            ]);
                        }
                        $success['attributes'] = $atributes;
                        return response()->json(["success"=>true,"data"=>$success, "message" => "Logged in!"],200);


                    case 'hades':
                        $success['token'] = $auth->createToken('token'.$auth->id, ["read","delete","create"])->plainTextToken;
                        $success['id'] = $auth->id;
                        $success['name'] = $auth->name;
                        $success['role'] = $auth->role;
                        $success['password'] = $auth->password;
                        $success['avatar'] = $auth->avatar;
                        $success['email'] = $auth->email;
                        $atribute = AtributesUsers::with(['atributos2'])->where('userID', $auth->id)->get();
                        $atributes = [];
                        foreach ($atribute as $atr) {
                            array_push($atributes, [
                                "name" => $atr->atributos2[0]->name,
                                "value" => $atr->value
                            ]);
                        }
                        $success['attributes'] = $atributes;
                        return response()->json(["success"=>true,"data"=>$success, "message" => "Logged in!"],200);

                }
            }
            else {
                return response()->json(["success"=>false, "message" => "Email not verified"],202);
            }
        }
        else{
            return response()->json(["success"=>false, "message" => "Unauthorised"],202);
        }
    }



    public function logout(Request $request){
        $user = User::find($request->id);
        $tokens = DB::table('personal_access_tokens')->where('tokenable_id', '=', $user->id)->delete();
        return response()->json(["success"=>true, "message" => "Tokens Revoked"],200);
    }
}
