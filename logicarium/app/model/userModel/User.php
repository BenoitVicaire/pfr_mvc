<?php 

namespace App\Model\UserModel;

class User{
    private int $id;
    private string $name;
    private string $password;
    private string $created_at;
    private string $email;
    private int $avatar;

    // Constructor

    public function __construct(
        int $id,
        string $name,
        string $password,
        string $created_at,
        string $email,
        int $avatar
        ){
            $this->id = $id;
            $this->name = $name;
            $this->password = $password;
            $this->created_at = $created_at;
            $this->email = $email;
            $this->avatar = $avatar;
        }

    // Getter and Setter
    public function getId(): int { return $this->id; }
    public function setId(int $id): self { $this->id = $id; return $this; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }

    public function getPassword(): string { return $this->password; }
    public function setPassword(string $password): self { $this->password = $password; return $this; }

    public function getCreatedAt(): string { return $this->created_at; }
    public function setCreatedAt(string $created_at): self { $this->created_at = $created_at; return $this; }

    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }

    public function getAvatar(): int { return $this->avatar; }
    public function setAvatar(int $avatar): self { $this->avatar = $avatar; return $this; }
}