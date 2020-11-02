<?php

namespace App\Models;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private ?string $referredBy;

    public function __construct(
        int $id,
        string $name,
        string $email,
        string $password,
        string $referredBy = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->referredBy = $referredBy;
    }

    public static function create(array $data): User
    {
        return new self(
            $data['name'],
            $data['email'],
            password_hash($data['password'], PASSWORD_BCRYPT),
            $data['referred_by']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'referred_by' => $this->referredBy,
        ];
    }
}
