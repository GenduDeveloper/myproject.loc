<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comment;

class ArticlesController extends AbstractController
{
    /**
     * @throws NotFoundException
     */
    public function view(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        $comments = Comment::findCommentsByArticleId($articleId);

        $this->view->renderHtml('articles/view.php',
            [
                'article' => $article,
                'comments' => $comments
            ]);
    }

    /**
     * @throws NotFoundException
     */
    public function edit(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException('Вы не авторизованы');
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('У вас недостаточно прав');
        }

        if (!empty($_POST)) {
            try {
                $article->editArticleById($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/edit.php',
                    [
                        'error' => $e->getMessage(),
                        'article' => $article
                    ]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/edit.php',
            [
                'pageName' => 'Редактирование статьи',
                'article' => $article
            ]);
    }

    public function add(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException('Вы не авторизованы');
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('У вас недостаточно прав');
        }


        if (!empty($_POST)) {
            try {
                $article = Article::createNewArticle($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/add.php',
            [
                'pageName' => 'Создание новой статьи'
            ]);
    }

    /**
     * @throws NotFoundException
     */
    public function delete(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        $comments = Comment::findCommentsByArticleId($articleId);

        if ($this->user === null) {
            throw new UnauthorizedException('Вы не авторизованы');
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('У вас недостаточно прав');
        }

        foreach ($comments as $comment) {
            $comment->delete();
        }

        $article->delete();

        $this->view->renderHtml('articles/deleteSuccessful.php',
            [
                'pageName' => 'Удаление статьи'
            ]);
    }
}