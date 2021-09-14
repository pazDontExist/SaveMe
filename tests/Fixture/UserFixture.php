<?php

namespace App\Test\Fixture;

use App\Domain\Users\Type\UserRoleType;
use App\LugCE\Definition;

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
            'first_name' => 'tizio',
            'last_name' => 'caio',
            'password' => 'aeae379a6e857728e44164267fdb7a0e27b205d757cc19899586c89dbb221930f1813d02ff93a661859bc17065eac4d6edf3c38a034e6283a84754d52917e5b0', // asdasd
            'email' => 'user@example.com',
            'user_type' => Definition::REPORTER,
            'locale' => 'it_IT',
            'created_at' => '2019-01-09 14:05:19',
            'updated_at' => '2019-01-09 14:05:19',
        ],
        [
            'id' => 3,
            'first_name' => 'ajeje',
            'last_name' => 'brazof',
            'password' => 'aeae379a6e857728e44164267fdb7a0e27b205d757cc19899586c89dbb221930f1813d02ff93a661859bc17065eac4d6edf3c38a034e6283a84754d52917e5b0', // asdasd
            'email' => 'ajeje@example.com',
            'user_type' => Definition::DOGHOUSE,
            'locale' => 'it_IT',
            'created_at' => '2019-01-09 14:05:19',
            'updated_at' => '2019-01-09 14:05:19',
        ],
    ];
}