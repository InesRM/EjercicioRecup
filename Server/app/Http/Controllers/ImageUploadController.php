<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\File;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Response;
use TheSeer\Tokenizer\Exception;

class ImageUploadController extends Controller
{
    function index()
    {
        return UserResource::collection(User::all());
    }


    function store(Request $request)
    {

        $this->validate($request, [
            'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        try {
            $user = User::get()->last()->id;
            $file = $request->file('file');
            $name = time() . $file->getClientOriginalName();
            $path = $request->file('file')->storeAs('avatar', $name, 'public');
            $file = new File();
            $file->name = $name;
            $file->userID = $user;
            $file->url = $path;
            $file->save();
            User::where('id', $user)->update(['avatar' => $path]);
            Gate::allows('update', $file);

            return response()->json(['success' => 'You have successfully upload image.']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    function updateStore(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        try {
            $id= $request->id;
            $user = User::get()->last()->id;
            $file = $request->file('file');
            $name = time() . $file->getClientOriginalName();
            $path = $request->file('file')->storeAs('avatar', $name, 'public');
            $file = new File();
            $file->name = $name;
            $file->userID = $user;
            $file->url = $path;
            $file->save();
            User::where('id', $user)->update(['avatar' => $path]);
            Gate::allows('update', $file);

            return response()->json(['success' => 'You have successfully update image.']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    function getAvatar($id)
    {
        $user = User::find($id);
        $avatar = $user->avatar;
        $resource=Storage::disk('public')->get($avatar);
        return Response::make($resource, 200, [
            'Content-Type' => 'image/jpegc, image/png, image/jpg, image/gif, image/svg',
            'Content-Disposition' => 'inline; filename="'.$avatar.'"'
        ]);
    }

    function destroy(File $file)
    {
        $file->delete();
        return new UserResource($file);
    }
    }



