<?php

namespace MyProject\Controllers;

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

        $this->view->renderHtml('users/profile.php', ['pageName' => 'Ваш профиль', 'user' => $user]);
    }
}
