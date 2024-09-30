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
    public function mainAdmin(): void
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

    public function viewArticles(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException('Вы не авторизованы');
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('Недостаточно прав');
        }

        $this->articlesPages(1);
    }

    public function articlesPages(int $pageNum): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException('Вы не авторизованы');
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('Недостаточно прав');
        }

        $articles = Article::getPage($pageNum, 5);

        if (empty($articles)) {
            throw new ArticlesNotFoundException('Не найдено ни одной статьи');
        }

        $this->view->renderHtml('admins/allArticles.php',
        [
            'articles' => $articles,
            'pagesCount' => Article::getPagesCount(5),
            'currentPageNum' => $pageNum,
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
