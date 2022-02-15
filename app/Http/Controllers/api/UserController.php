<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Http\Requests\API\UserCreateRequest;
use App\Http\Requests\API\UserUpdateRequest;
use App\Http\Requests\API\UserDeleteRequest;
use App\Http\Controllers\AppBaseController;
use App\Services\UserService;

class UserController extends AppBaseController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {

        return response()->json(
            ['users' => $this->userService->getUsers()],
            200
        )->header('Content-Type', 'application/json');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createUser(UserCreateRequest $request)
    {
        $user = $this->userService->createUser([
            'name' => $request->name,
            'email' => $request->email,
            'sex' => $request->sex,
        ]);

        return response()->json([
            'user' => $user
        ], 200)->header('Content-Type', 'application/json');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(UserUpdateRequest $request)
    {
        $this->userService->updateUser(
            $request->id,
            [
                'name' => $request->name,
                'email' => $request->email,
                'sex' => $request->sex,
            ],
        );


        return response()->json([
            'status' => 'success'
        ], 200)->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser(UserDeleteRequest $request)
    {
        $this->userService->deleteUser($request->id);
        return response()->json([
            'status' => 'success'
        ], 200)->header('Content-Type', 'application/json');
    }
}
