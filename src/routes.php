<?php

return [
    '~^articles/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'view'],
    '~^articles/(\d+)/edit$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'],
    '~^articles/add$~' => [\MyProject\Controllers\ArticlesController::class, 'add'],
    '~^articles/(\d+)/delete$~' => [\MyProject\Controllers\ArticlesController::class, 'delete'],
    '~^articles/(\d+)/comments$~' => [\MyProject\Controllers\CommentsController::class, 'addComment'],
    '~^comments/(\d+)/edit$~' => [\MyProject\Controllers\CommentsController::class, 'editComment'],
    '~^comments/(\d+)/delete$~' => [\MyProject\Controllers\CommentsController::class, 'deleteComment'],
    '~^users/register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'],
    '~^users/(\d+)/activate/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'activate'],
    '~^users/login$~' => [\MyProject\Controllers\UsersController::class, 'login'],
    '~^users/logout$~' => [\MyProject\Controllers\UsersController::class, 'logout'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^(\d+)$~' => [\MyProject\Controllers\MainController::class, 'page'],
    '~^users/profile$~' => [\MyProject\Controllers\ProfilesController::class, 'showProfile'],
    '~^users/profile/edit$~' => [\MyProject\Controllers\ProfilesController::class, 'editProfile'],
    '~^users/profile/edit/name$~' => [\MyProject\Controllers\ProfilesController::class, 'editName'],
    '~^users/profile/edit/password$~' => [\MyProject\Controllers\ProfilesController::class, 'editPassword'],
    '~^admin$~' => [\MyProject\Controllers\AdminsController::class, 'mainAdmin'],
    '~^admin/articles$~' => [\MyProject\Controllers\AdminsController::class, 'viewArticles'],
    '~^admin/articles/(\d+)$~' => [\MyProject\Controllers\AdminsController::class, 'articlesPages'],
    '~^admin/(\d+)/comments$~' => [\MyProject\Controllers\AdminsController::class, 'allCommentsFromArticle']
];
