<?php

namespace App\Infrastructure\Postgres\User;

use App\Domain\Common\ValueObject\UUId;
use App\Models\User AS UserModel;
use App\Domain\User\Entity\User;
use App\Domain\User\Interface\UserRepositoryInterface;
use App\Domain\User\Factory\UserFactory;
use App\Domain\User\ValueObject\Email;
use App\Exceptions\DatabaseOperationException;

class UserPostgresRepository implements UserRepositoryInterface
{
    public function __construct(
        private readonly UserFactory $userFactory
    ) {}

    public function findById(UUId $id): ?User
    {
        $model = UserModel::find($id->value());
        return $model ? $this->toDomainModel($model) : null;
    }

    public function findByEmail(email $email): ?User
    {
        $model = UserModel::where(
            column: 'email',
            operator: '=',
            value: $email->value()
        )->first();

        return  $model ? $this->toDomainModel($model) : null;
    }

    public function create(User $user):void
    {
        try {
            UserModel::create(
                [
                    'user_id' => $user->id()->value(),
                    'email' => $user->email()->value(),
                    'password' => $user->userPassword()->value(),
                    'user_name' => $user->userName()
                ]
            );
        } catch (\Exception $e) {
            throw new DatabaseOperationException('ユーザーの作成に失敗しました。');
        }
    }

    public function update(User $user): void
    {
        try {
            UserModel::where('user_id', $user->id()->value())->update([
                        'email'     => $user->email()->value(),
                        'password'  => $user->userPassword()->value(),
                        'user_name' => $user->userName(),
                    ]);
        } catch (\Exception $e) {
            throw new DatabaseOperationException('ユーザーの更新に失敗しました。');
        }
    }

    public function delete(User $user): void
    {
        try {
            UserModel::destroy($user->id()->value());
        } catch (\Exception $e) {
            throw new DatabaseOperationException('ユーザーの削除に失敗しました。');
        }
    }

    private function toDomainModel(UserModel $model): User
    {
        return $this->userFactory->reconstruct(
            userId: $model->getAttribute('user_id'),
            email: $model->getAttribute('email'),
            password: $model->getAttribute('password'),
            userName: $model->getAttribute('user_name'),
        );
    }
}
