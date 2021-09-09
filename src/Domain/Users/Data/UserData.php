<?php

namespace App\Domain\Users\Data;

use Selective\ArrayReader\ArrayReader;

/**
 * Data Model.
 */
final class UserData
{
    public ?int $id = null;

    public ?string $first_name = null;

    public ?string $last_name = null;

    public ?string $email = null;

    public ?string $password = null;

    public ?string $created_at = null;

    public ?string $updated_at = null;

    public ?string $locale = null;

    public ?int $user_type = null;

    /**
     * The constructor.
     *
     * @param array $data The data
     */
    public function __construct(array $data = [])
    {
        $reader = new ArrayReader($data);

        $this->id = $reader->findInt('id');
        $this->first_name = $reader->findString('first_name');
        $this->last_name = $reader->findString('last_name');
        $this->email = $reader->findString('email');
        $this->password = $reader->findString('password');
        $this->created_at = $reader->findString('created_at');
        $this->updated_at = $reader->findString('updated_at');
        $this->locale = $reader->findString('locale');
        $this->user_type = $reader->findInt('user_type');
    }
}