<?php

declare(strict_types=1);

namespace App\Infrastructure\Postgres\User;

use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Domain\User\Interface\UserQueryInterface;
use App\Usecases\User\GetUserList\Dto\UserListItemDto;
use App\Usecases\User\GetUserList\Dto\GetUserListRequestDto;
use App\Usecases\User\GetUserList\Dto\GetUserListResponseDto;

class UserPostgresQuery implements UserQueryInterface
{

    public function fetchUserList(GetUserListRequestDto $dto): GetUserListResponseDto
    {
        $query = User::query();

        // 検索条件を適用
        $this->applyFilters(
            query: $query,
            dto: $dto
        );

        // ソート順を適用
        $this->applySorting($query);

        $totalCount = $query->count();

        //ページネーション
        $users = $query->offset(($dto->page - 1) * $dto->limit)
            ->limit($dto->limit)
            ->get();

        return new GetUserListResponseDto(
            totalCount: $totalCount,
            data: $users->map(fn($user) => $this->toListItemDto($user))->all()
        );
    }

    private function applyFilters(Builder $query, GetUserListRequestDto  $dto): void
    {
        if (!empty($dto->email)) {
            $query->where(
                column: 'email',
                operator: 'like',
                value: '%' . $dto->email . '%'
            );
        }

        if (!empty($dto->userName)) {
            $query->where(
                column: 'user_name',
                operator: 'like',
                value: '%' . $dto->userName . '%'
            );
        }
    }

    private function applySorting(Builder $query): void
    {
        $query->orderBy('updated_at', 'DESC')->orderBy('user_id', 'ASC');
    }

    private function toListItemDto(User $user): UserListItemDto
    {
        return new UserListItemDto(
            userId: $user->getAttribute('user_id'),
            userName: $user->getAttribute('user_name'),
            email: $user->getAttribute('email'),
        );
    }
}
