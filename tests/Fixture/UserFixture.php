<?php

namespace App\Test\Fixture;

use App\Domain\Users\Type\UserRoleType;

/**
 * Fixture.
 */
class UserFixture
{
    /** @var string Table name */
    public $table = 'users';

    /**
     * Records.
     *
     * @var array<mixed> Records
     */
    public $records = [
        [
            'id' => 2,
            'username' => 'admin',
            'password' => 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86',
            'email' => 'admin@example.com',
            'first_name' => null,
            'last_name' => null,
            'user_role_id' => UserRoleType::ROLE_ADMIN,
            'locale' => 'en_US',
            'enabled' => 1,
            'created_at' => '2019-01-09 14:05:19',
            'created_user_id' => 1,
            'updated_at' => null,
            'updated_user_id' => null,
        ],
        [
            'id' => 3,
            'username' => 'user',
            'password' => '$1$X64.UA0.$kCSxRsj3GKk7Bwy3P6xn1.',
            'email' => 'user@example.com',
            'first_name' => null,
            'last_name' => null,
            'user_role_id' => UserRoleType::ROLE_USER,
            'locale' => 'de_DE',
            'enabled' => 1,
            'created_at' => '2019-02-01 00:00:00',
            'created_user_id' => 1,
            'updated_at' => null,
            'updated_user_id' => null,
        ],
    ];
}