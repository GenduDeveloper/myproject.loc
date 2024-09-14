<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\InvalidActivationException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Users\User;
use MyProject\Models\Users\UserActivationService;
use MyProject\Services\EmailSender;
use MyProject\View\View;

class UsersController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function signUp(): void
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                return;
            }

            if ($user instanceof User) {
                $code = UserActivationService::createActivationCode($user);

                $mail = new EmailSender();
                $mail->send($user, 'Активация', 'userActivation.php',
                    [
                        'userId' => $user->getId(),
                        'code' => $code
                    ]);

                $this->view->renderHtml('users/signUpSuccessful.php', ['pageName' => 'Регистрация прошла успешна']);
                return;
            }
        }

        $this->view->renderHtml('users/signUp.php', ['pageName' => 'Регистрация']);
    }

    public function activate(int $userId, string $activationCode): void
    {
        try {
            $user = User::getById($userId);

            if ($user === null) {
                throw new InvalidActivationException('Пользователь не найден');
            }

            if ($user->getConfirmed()) {
                throw new InvalidActivationException('Этот аккаунт уже активирован');
            }

            $isCodeValid = UserActivationService::checkActivationCode($user, $activationCode);

            if (!$isCodeValid) {
                throw new InvalidActivationException('Неверный код активации');
            }

            $user->activate();
            $this->view->renderHtml('users/activationSuccessful.php', ['pageName' => 'Активация прошла успешно']);
            UserActivationService::deleteActivationCode($userId);
        } catch (InvalidActivationException $e) {
            $this->view->renderHtml('users/activationError.php',
                [
                    'pageName' => 'Не удалось активировать пользователя',
                    'error' => $e->getMessage()
                ], 400
            );
        }
    }
}
