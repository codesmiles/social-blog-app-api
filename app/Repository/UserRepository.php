<?php
namespace App\Repository;

use App\Exceptions\GenericExceptions;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\Response;

class UserRepository implements UserInterface
{
    public function welcome()
    {

            return response()->json([
                "message" => "Welcome to the blog API",
                // "update" =>"what's up"

            ]);

    }

    public function profile($request)
    {
        try {
            $user = User::where('id', auth()->user()->id)->first();

            throw_if(!$user, GenericExceptions::class, "User not found", Response::HTTP_NOT_FOUND);
            return $user;

        } catch (\Throwable$e) {
            echo $e->getMessage();
        }
    }

    public function search($request)
    {
        $user = User::where('name', $request->name)->first();
        if (!$user) {
            return response()->json([
                "message" => "User not found",
            ], 400);
        }

        $self = User::where('name', auth()->user()->name)->first();
        if ($user == $self) {
            return response()->json([
                "message" => "Cannot search for self",
            ], 400);
        }

        return $user;
    }

}
