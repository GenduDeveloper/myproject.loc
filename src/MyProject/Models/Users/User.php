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

    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getConfirmed(): int
    {
        return $this->isConfirmed;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
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

    public static function login(array $userData): User
    {
        if (empty($userData['email'])) {
            throw new InvalidArgumentException('Не передан адрес электронной почты');
        }

        if (empty($userData['password'])) {
            throw new InvalidArgumentException('Не передан пароль');
        }

        $user = User::findOneByColumn('email', $userData['email']);
        if ($user === null) {
            throw new InvalidArgumentException('Такого пользователя не существует');
        }

        /**
         * @var User $user
         */
        if (!password_verify($userData['password'], $user->getPasswordHash())) {
            throw new InvalidArgumentException('Неправильный пароль');
        }

        $user->refreshAuthToken();
        $user->save();

        return $user;
    }

    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    private function refreshAuthToken(): void
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }

    public static function updateName(array $userData, User $user): User
    {
        if (empty($userData['new_nickname'])) {
            throw new InvalidArgumentException('Не передано новое имя');
        }

        if (!preg_match('~^[a-zA-Z0-9]+$~', $userData['new_nickname'])) {
            throw new InvalidArgumentException('Имя профиля может состоять только из символов латинского алфавита и цифр');
        }

        if (static::findOneByColumn('nickname', $userData['new_nickname']) !== null) {
            throw new InvalidArgumentException('Такое имя уже существует');
        }

        $user->setNickname($userData['new_nickname']);
        $user->save();

        return $user;
    }

    public static function checkPasswordVerification(string $password, User $user): bool
    {
        return password_verify($password, $user->getPasswordHash());
    }

    public static function updatePassword(array $userData, User $user): User
    {
        if (empty($userData['password'])) {
            throw new InvalidArgumentException('Не передан текущий пароль');
        }

        if (!self::checkPasswordVerification($userData['password'], $user)) {
            throw new InvalidArgumentException('Введен неправильный пароль');
        }

        if (empty($userData['new_password'])) {
            throw new InvalidArgumentException('Не передан новый пароль');
        }

        if (mb_strlen($userData['new_password']) < 8) {
            throw new InvalidArgumentException('Пароль должен быть не менее 8 символов');
        }

        if (empty($userData['new_password_repeat'])) {
            throw new InvalidArgumentException('Вы не повторили новый пароль');
        }

        if ($userData['new_password'] !== $userData['new_password_repeat']) {
            throw new InvalidArgumentException('Новый пароль не совпадает');
        }

        $user->setPasswordHash(password_hash($userData['new_password'], PASSWORD_DEFAULT));
        $user->save();

        return $user;
    }

}
