<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\User\GetUserListRequest;
use App\Http\Requests\User\GetUserRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Usecases\User\GetUserList\GetUserListUsecase;
use App\Usecases\User\GetUser\GetUserUsecase;
use App\Usecases\User\CreateUser\CreateUserUsecase;
use App\Usecases\User\UpdateUser\UpdateUserUsecase;
use App\Usecases\User\DeleteUser\DeleteUserUsecase;


class UserController extends Controller
{

    public function __construct(
        private readonly GetUserListUsecase $getUserListUsecase,
        private readonly GetUserUsecase $getUserUsecase,
        private readonly CreateUserUsecase $createUserUsecase,
        private readonly UpdateUserUsecase $updateUserUsecase,
        private readonly DeleteUserUsecase $deleteUserUsecase
    ) {}

    /**
     *  ユーザー一覧情報を取得
     *  
     *  @response array{
     *    data: array<array{
     *      userId: string,
     *      userName: string,
     *      email: string
     *    }>,
     *    totalCount: int
     *  }
     */
    public function index(GetUserListRequest $request): object
    {
        $users = $this->getUserListUsecase->handle($request->toDto());
        return response()->json([$users]);
    }

    /**
     * ユーザー詳細情報を取得
     * 
     * @response array{
     *     userId: string,
     *     userName: string,
     *     email: string
     * }
     */
    public function show(GetUserRequest $request): object
    {
        $user = $this->getUserUsecase->handle($request->toDto());
        return response()->json([$user]);
    }

    /**
     * ユーザー登録
     */
    public function store(CreateUserRequest $request): object
    {
        $this->createUserUsecase->handle($request->toDto());
        return response()->noContent();
    }

    /**
     * ユーザー更新
     */
    public function update(UpdateUserRequest $request): object
    {
        $this->updateUserUsecase->handle($request->toDto());
        return response()->noContent();
    }


    /**
     * ユーザー削除
     */
    public function delete(DeleteUserRequest $request): object
    {
        $this->deleteUserUsecase->handle($request->toDto());
        return response()->noContent();
    }
}
