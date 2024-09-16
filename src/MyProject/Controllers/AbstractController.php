<?php

namespace MyProject\Controllers;

use MyProject\Models\Users\User;
use MyProject\Models\Users\UserAuthService;
use MyProject\View\View;

abstract class AbstractController
{
    protected View $view;
    protected ?User $user;

    public function __construct()
    {
        $this->user = UserAuthService::getUserByToken();
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('user', $this->user);
    }
}
