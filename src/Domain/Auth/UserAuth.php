<?php

namespace App\Domain\Auth;

use App\Factory\QueryFactory;
use App\LugCE\Definition;
use PDO;

class UserAuth
{
    /**
     * @var PDO
     */
    private PDO $connection;
    private QueryFactory $query;

    /**
     * UserAuth constructor.
     * @param PDO $pdo Database Connection
     */
    function __construct(PDO $pdo, QueryFactory $query)
    {
        $this->connection = $pdo;
        $this->query = $query;
    }

    /**
     * @param string $username Email
     * @param string $password Password
     * @return array
     */
    public function authenticate(string $username, string $password): array
    {

        $password = hash('sha512', $password);

        $q = "SELECT * FROM users WHERE email = :email AND password = :password";
        $st = $this->connection->prepare($q);
        $st->bindParam(":email", $username);
        $st->bindParam(":password", $password);

        $st->execute();

        $data = $st->fetchAll();

        if (empty($data)) {
            return [];
        }

        return [
            'fname'     => $data[0]['first_name'],
            'lname'     => $data[0]['last_name'],
            'uid'       => $data[0]['id'],
            'role'      => $data[0]['user_type'],
            'locale'    => $data[0]['locale'],
            'email'    => $data[0]['email'],
        ];
    }

    public function register($data){
        $fname = filter_var($data['fname'], FILTER_SANITIZE_STRING);
        $lname = filter_var($data['lname'], FILTER_SANITIZE_STRING);
        $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
        $password = hash('sha512', $data['passwd']);
        $type = Definition::REPORTER;

        return $this->query->newInsert('users', $data);

    }
}
