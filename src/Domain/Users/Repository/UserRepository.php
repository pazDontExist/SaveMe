<?php

namespace App\Domain\Users\Repository;

use App\Domain\Users\Data\UserData;
use App\Factory\QueryFactory;
use Cake\Chronos\Chronos;
use DomainException;

/**
 * Repository.
 */
final class UserRepository
{
    private QueryFactory $queryFactory;

    /**
     * The constructor.
     *
     * @param QueryFactory $queryFactory The query factory
     */
    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    /**
     * Insert user row.
     *
     * @param UserData $user The user data
     *
     * @return int The new ID
     */
    public function insertUser(UserData $user): int
    {
        $row = $this->toRow($user);
        $row['created_at'] = Chronos::now()->toDateTimeString();
        $row['updated_at'] = Chronos::now()->toDateTimeString();

        return (int)$this->queryFactory->newInsert('users', $row)
            ->execute()
            ->lastInsertId();
    }

    /**
     * Get user by id.
     *
     * @param int $userId The user id
     *
     * @throws DomainException
     *
     * @return UserData The user
     */
    public function getUserById(int $userId): UserData
    {
        $query = $this->queryFactory->newSelect('users');
        $query->select(
            [
                'id',
                'username',
                'first_name',
                'last_name',
                'email',
                'user_role_id',
                'locale',
                'enabled',
                'game_room_id',
            ]
        );

        $query->andWhere(['id' => $userId]);

        $row = $query->execute()->fetch('assoc');

        if (!$row) {
            throw new DomainException(sprintf('User not found: %s', $userId));
            //$row = [];
        }

        return new UserData($row);
    }

    /**
     * Update user row.
     *
     * @param UserData $user The user
     *
     * @return array
     */
    public function updateUser(UserData $user): array
    {
        $row = $this->toRow($user);

        // Updating the password is another use case
        unset($row['password']);
        unset($row['created_at']);
        unset($row['locale']);
        unset($row['user_type']);

        $row['updated_at'] = Chronos::now()->toDateTimeString();

        if (!$this->queryFactory->newUpdate('users', $row)
            ->andWhere(['id' => $user->id])
            ->execute()) {
            return ['status'=>'error', 'message' => __('Something went wrong, try again later')];
        }

        return ['status'=>'success', 'message' => __('Updated Successfull')];
    }

    public function updateUserPassword(UserData $user): array
    {
        $row = $this->toRow($user);

        // Unsetta tutto tranne pwd
        // lo so...è na strunzat

        unset($row['first_name']);
        unset($row['last_name']);
        unset($row['email']);
        unset($row['updated_at']);
        unset($row['locale']);
        unset($row['user_type']);
        
        $row['password'] = hash('sha512', $row['password']);
        $row['updated_at'] = Chronos::now()->toDateTimeString();

        if (!$this->queryFactory->newUpdate('users', $row)
            ->andWhere(['id' => $user->id])
            ->execute()) {
            return ['status'=>'error', 'message' => __('Something went wrong, try again later')];
        }

        return ['status'=>'success', 'message' => __('Updated Successfull')];
    }

    /**
     * Check user id.
     *
     * @param int $userId The user id
     *
     * @return bool True if exists
     */
    public function existsUserId(int $userId): bool
    {
        $query = $this->queryFactory->newSelect('users');
        $query->select('id')->andWhere(['id' => $userId]);

        return (bool)$query->execute()->fetch('assoc');
    }

    /**
     * Delete user row.
     *
     * @param int $userId The user id
     *
     * @return void
     */
    public function deleteUserById(int $userId): void
    {
        $this->queryFactory->newDelete('users')
            ->andWhere(['id' => $userId])
            ->execute();
    }

    /**
     * Convert to array.
     *
     * @param UserData $user The user data
     *
     * @return array The array
     */
    private function toRow(UserData $user): array
    {
        return [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'password' => $user->password,
            //'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'locale' => $user->locale,
            'user_type' => (int)$user->user_type,
        ];
    }
}
