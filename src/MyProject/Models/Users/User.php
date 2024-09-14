<?php

namespace MyProject\Models\Users;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;

class User extends ActiveRecordEntity
{
    protected string $nickname;
    protected string $email;
    protected int $isConfirmed;
    protected string $role;
    protected string $passwordHash;
    protected string $authToken;
    protected ?string $createdAt = null;

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getConfirmed(): int
    {
        return $this->isConfirmed;
    }

    protected static function getTableName(): string
    {
        return 'users';
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function signUp(array $userData): User
    {
        if (empty($userData['nickname'])) {
            throw new InvalidArgumentException('Не передано имя профиля');
        }

        if (!preg_match('~^[a-zA-Z0-9]+$~', $userData['nickname'])) {
            throw new InvalidArgumentException('Имя профиля может состоять только из символов латинского алфавита и цифр');
        }

        if (static::findOneByColumn('nickname', $userData['nickname']) !== null) {
            throw new InvalidArgumentException('Такое имя профиля уже существует');
        }

        if (empty($userData['email'])) {
            throw new InvalidArgumentException('Не передан адрес электронной почты');
        }

        if (static::findOneByColumn('email', $userData['email']) !== null) {
            throw new InvalidArgumentException('Такой адрес электронной почты уже существует');
        }

        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Неккоретный адрес электронной почты');
        }

        if (empty($userData['password'])) {
            throw new InvalidArgumentException('Не передан пароль');
        }

        if (mb_strlen($userData['password']) < 8) {
            throw new InvalidArgumentException('Пароль должен быть не менее 8 символов');
        }

        $user = new User();
        $user->nickname = $userData['nickname'];
        $user->email = $userData['email'];
        $user->isConfirmed = false;
        $user->role = 'user';
        $user->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
        $user->save();

        return $user;
    }

    public function activate(): void
    {
        $this->isConfirmed = true;
        $this->save();
    }
}
