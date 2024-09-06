<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\Services\Db;
use MyProject\View\View;

class ArticlesController
{
    private Db $db;
    private View $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->db = new Db();
    }

    public function view(int $articleId): void
    {
        $article = $this->db->query(
            'SELECT * FROM articles WHERE id = :articleId',
            [':articleId' => $articleId], Article::class
        );

        if ($article === []) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $authorId = $article[0]->getAuthorId();
        $author = $this->db->query(
            'SELECT nickname FROM users WHERE id = :authorId',
            [':authorId' => $authorId], User::class
        );

        $this->view->renderHtml('articles/view.php', ['article' => $article[0], 'author' => $author[0]]);
    }
}