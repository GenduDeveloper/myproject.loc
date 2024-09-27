<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Exceptions\UserNotFoundException;
use MyProject\Models\Users\User;

class ProfileController extends AbstractController
{
    public function showProfile(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException('Вы не авторизованы');
        }

        $userId = $this->user->getId();
        $user = User::getById($userId);

        if ($user === null) {
            throw new UserNotFoundException('Пользователь не найден');
        }

        $this->view->renderHtml('users/profile.php',
            [
                'pageName' => 'Ваш профиль',
                'user' => $user
            ]);
    }

    public function editProfile(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException('Вы не авторизованы');
        }

        $userId = $this->user->getId();
        $user = User::getById($userId);

        if ($user === null) {
            throw new UserNotFoundException('Пользователь не найден');
        }

        $this->view->renderHtml('users/editProfile.php',
            [
                'pageName' => 'Редактирование профиля',
                'user' => $user
            ]);
    }

    public function editName(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException('Вы не авторизованы');
        }

        $userId = $this->user->getId();
        $user = User::getById($userId);

        if ($user === null) {
            throw new UserNotFoundException('Пользователь не найден');
        }

        try {
            if (!empty($_POST)) {
                User::updateName($_POST, $user);
                $this->view->renderHtml('users/editProfile.php',
                    [
                        'successfully' => 'Успешно обновлено'
                    ]);
                return;
            }
        } catch (InvalidArgumentException $e) {
            $this->view->renderHtml('users/editProfile.php', ['error' => $e->getMessage()]);
            return;
        }

        $this->view->renderHtml('users/editProfile.php',
            [
                'pageName' => 'Редактирование профиля',
                'user' => $user
            ]);
    }

    public function editPassword(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException('Вы не авторизованы');
        }

        $userId = $this->user->getId();
        $user = User::getById($userId);

        if ($user === null) {
            throw new UserNotFoundException('Пользователь не найден');
        }

        try {
            if (!empty($_POST)) {
                User::updatePassword($_POST, $user);
                $this->view->renderHtml('users/editProfile.php', ['successfully' => 'Успешно обновлено']);
                return;
            }
        } catch (InvalidArgumentException $e) {
            $this->view->renderHtml('users/editProfile.php', ['error' => $e->getMessage()]);
            return;
        }

        $this->view->renderHtml('users/editProfile.php',
            [
                'pageName' => 'Редактирование профиля',
                'user' => $user
            ]);
    }
}
