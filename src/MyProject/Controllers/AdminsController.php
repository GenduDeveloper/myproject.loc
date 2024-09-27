<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ArticlesNotFoundException;
use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comment;

class AdminsController extends AbstractController
{
    public function viewAdmin(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException('Вы не авторизованы');
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('Недостаточно прав');
        }

        $this->view->renderHtml('admins/view.php',
            [
                'pageName' => 'Админ. панель',
            ]);
    }

    public function allArticles(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException('Вы не авторизованы');
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('Недостаточно прав');
        }

        $articles = Article::findAll();

        if (!$articles) {
            throw new ArticlesNotFoundException('Ни одной статьи не найдено');
        }

        $this->view->renderHtml('admins/allArticles.php',
            [
                'pageName' => 'Статьи',
                'articles' => $articles,
            ]);
    }

    public function allCommentsFromArticle(int $articleId): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException('Вы не авторизованы');
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('Недостаточно прав');
        }

        $comments = Comment::findCommentsByArticleId($articleId);

        if ($comments === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('admins/allComments.php',
            [
                'pageName' => 'Комментарии к статье',
                'comments' => $comments,
            ]);

    }
}
