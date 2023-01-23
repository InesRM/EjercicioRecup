<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\AtributesUsers;
use App\Models\HumanData;
use App\Http\Resources\UserResource;
class UserController extends Controller
{


    public function allUsers() {
        $pers = User::all();

        return response()->json($pers,200);
    }

    public function updateUser(Request $request) {
        User::find($request->id)->update(['password' => bcrypt($request->new_password)]);
        // User::find($request->id)->update(['name' => $request->name]);
        // User::find($request->id)->update(['email' => $request->email]);
        User::find($request->id)->update(['avatar' => $request->avatar]);
        return response()->json(["success"=>true, "message" => "User updated successfully"],200);
    }


    public function updateAttributes(Request $request) {
        $atribute = AtributesUsers::with(['atributos2'])->where('userID', $request->id)->get();
            foreach ($atribute as $atr) {
                $name = $atr->atributos2[0]->name;
                DB::table('atributes_users')
                    ->join('atributes', 'atributes_users.atributeID', '=', 'atributes.ID')
                    ->where('atributes_users.userID', '=', $request->id)
                    ->where('atributes.name', '=', $name)
                    ->update(['atributes_users.value' => $request->$name]);
            }

        return response()->json(["success"=>true, "message" => "Attributes changed successfully"],200);
    }

    public function createUsers(Request $request) {
        $quantity = $request->number;
        $counter = 0;
        while ($counter < $quantity){
            $userData = [
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => bcrypt('1234'), // password
                'role' => 'human',
            ];

            $user = User::create($userData);

            $dataH = [
                'ID' => $user->id,
                'destino' => 0,
                'protection' => $request->id
            ];
            HumanData::create($dataH);
            $cont = 1;
            while ($cont <= 5) {
                $dataA = [
                    'atributeID' => $cont,
                    'userID' => $user->id,
                    'value' => random_int(1, 5),
                    'created_at' => now(),
                    'updated_at' => now()
                ];
                AtributesUsers::create($dataA);
                $cont++;
            }
            $counter++;
        }
        return response()->json(["success"=>true, "message" => "Users created successfully"],200);
    }

    public function deleteUser($id) {
        $user = User::find($id);
        $user->delete();
        return response()->json(["success"=>true, "message" => "User deleted successfully"],200);
    }


    public function getAttributes(Request $request) {
        $atribute = AtributesUsers::with(['atributos2'])->where('userID', $request->id)->get();
        $atributes = [];
        foreach ($atribute as $atr) {
            array_push($atributes, [
                "name" => $atr->atributos2[0]->name,
                "value" => $atr->value
            ]);
        }
        return response()->json(["success"=>true, "attributes" => $atributes],200);
    }

   public function getUser ($id) {
        $user = User::find($id);
        return response()->json(["success"=>true, "user" => $user],200);
    }

    public function getFiles ($id) {
        $files = File::where('userID', $id)->get();
        return response()->json(["success"=>true, "files" => $files],200);
    }



}
