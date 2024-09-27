<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\AccessDeniedException;
use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comment;

class CommentsController extends AbstractController
{
    public function addComment(int $articleId): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException('Вы не авторизованы');
        }

        $authorId = $this->user->getId();

        if (!empty($_POST)) {
            try {
                $comments = Comment::addComment($_POST, $authorId, $articleId);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/view.php',
                    [
                        'error' => $e->getMessage(),
                        'article' => Article::getById($articleId),
                        'comments' => Comment::findCommentsByArticleId($articleId)
                    ]);
                return;
            }

            header('Location: /articles/' . $articleId . '#comment' . $comments->getId(), true, 302);
            exit();
        }
    }

    public function editComment(int $commentId): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException('Вы не авторизованы');
        }

        $comment = Comment::getById($commentId);

        if ($comment === null) {
            throw new NotFoundException('Комментарий не найден');
        }

        if ($this->user->getId() !== $comment->getAuthorId() && (!$this->user->isAdmin())) {
            throw new AccessDeniedException('Доступ запрещен. Вы не являетесь автором комментария');
        }

        if (!empty($_POST)) {
            try {
                Comment::editCommentById($_POST, $comment);
                header("Location: /articles/{$comment->getArticleId()}#comment{$comment->getId()}");
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('comments/edit.php',
                    [
                        'error' => $e->getMessage(),
                        'comment' => $comment
                    ]);
                return;
            }

        }

        $this->view->renderHtml('comments/edit.php',
            [
                'pageName' => 'Изменение комментария',
                'comment' => $comment
            ]);
    }

    public function deleteComment(int $commentId): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException('Вы не авторизованы');
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('У вас недостаточно прав');
        }

        $comment = Comment::getById($commentId);

        if ($comment === null) {
            throw new NotFoundException();
        }

        $comment->delete();
        $this->view->renderHtml('admins/deleteSuccessful.php', ['pageName' => 'Удаление комментария']);
    }
}
