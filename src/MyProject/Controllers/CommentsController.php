<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\InvalidArgumentException;
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
}
