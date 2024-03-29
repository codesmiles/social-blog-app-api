<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\UserInterface;

use App\Exceptions\GenericExceptions;
use Illuminate\Http\Response;


class UserController extends Controller
{
    private UserInterface $UserRepository;
    public function __construct(UserInterface $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    //------------------------------- WELCOME ------------------------------
    public function index()
    {
        throw new GenericExceptions("Reporting generic error", Response::HTTP_CONFLICT);
        // return $this->UserRepository->welcome();
        
        
    }

//  ----------------------------USER PROFILE -----------------------------------------
    public function profile(Request $request){
        $user = $this->UserRepository->profile($request);

        return response()->json([
            "message" => "successful",
            "user" => $user,
            "friends" => $user->friends,
        ], 200);
    }
   
    // ----------------------------SEARCH OTHER USER---------------------------
    public function search(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
        ]);
        throw_if($request->fails(), GenericExceptions::class, $request->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

        $user = $this->UserRepository->search($request);
        

        return response()->json([
            "message" => "successful",
            "user" => [
                "name" => $user->name,
                "email" => $user->email,
                "phone" => $user->phone
            ],
        ], 200);
    }

}