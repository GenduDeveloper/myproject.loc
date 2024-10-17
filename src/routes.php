<?php

return [
    // Articles
    '~^articles/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'view'],
    '~^articles/(\d+)/edit$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'],
    '~^articles/add$~' => [\MyProject\Controllers\ArticlesController::class, 'add'],
    '~^articles/(\d+)/delete$~' => [\MyProject\Controllers\ArticlesController::class, 'delete'],
    // Comments
    '~^articles/(\d+)/comments$~' => [\MyProject\Controllers\CommentsController::class, 'add'],
    '~^comments/(\d+)/edit$~' => [\MyProject\Controllers\CommentsController::class, 'edit'],
    '~^comments/(\d+)/delete$~' => [\MyProject\Controllers\CommentsController::class, 'delete'],
    // Users
    '~^users/register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'],
    '~^users/(\d+)/activate/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'activate'],
    '~^users/login$~' => [\MyProject\Controllers\UsersController::class, 'login'],
    '~^users/logout$~' => [\MyProject\Controllers\UsersController::class, 'logout'],
    // Main
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^(\d+)$~' => [\MyProject\Controllers\MainController::class, 'page'],
    // Profiles
    '~^users/profile$~' => [\MyProject\Controllers\ProfilesController::class, 'show'],
    '~^users/profile/edit$~' => [\MyProject\Controllers\ProfilesController::class, 'edit'],
    '~^users/profile/edit/name$~' => [\MyProject\Controllers\ProfilesController::class, 'editName'],
    '~^users/profile/edit/password$~' => [\MyProject\Controllers\ProfilesController::class, 'editPassword'],
    // Admins
    '~^admin$~' => [\MyProject\Controllers\AdminsController::class, 'main'],
    '~^admin/articles$~' => [\MyProject\Controllers\AdminsController::class, 'view'],
    '~^admin/articles/(\d+)$~' => [\MyProject\Controllers\AdminsController::class, 'articlesPages'],
    '~^admin/(\d+)/comments$~' => [\MyProject\Controllers\AdminsController::class, 'allCommentsFromArticle']
];
