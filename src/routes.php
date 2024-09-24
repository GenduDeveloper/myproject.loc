<?php

return [
    '~^articles/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'view'],
    '~^articles/(\d+)/edit$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'],
    '~^articles/add$~' => [\MyProject\Controllers\ArticlesController::class, 'add'],
    '~^articles/(\d+)/delete$~' => [MyProject\Controllers\ArticlesController::class, 'delete'],
    '~^articles/(\d+)/comments~' => [\MyProject\Controllers\CommentsController::class, 'addComment'],
    '~^users/register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'],
    '~^users/(\d+)/activate/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'activate'],
    '~^users/login$~' => [\MyProject\Controllers\UsersController::class, 'login'],
    '~^users/logout$~' => [\MyProject\Controllers\UsersController::class, 'logout'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^users/profile$~' => [\MyProject\Controllers\ProfileController::class, 'showProfile'],
    '~^users/profile/edit$~' => [\MyProject\Controllers\ProfileController::class, 'editProfile'],
    '~^users/profile/edit/name$~' => [\MyProject\Controllers\ProfileController::class, 'editName'],
    '~^users/profile/edit/password$~' => [\MyProject\Controllers\ProfileController::class, 'editPassword'],
];
