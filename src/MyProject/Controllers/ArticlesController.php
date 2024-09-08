<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\View\View;

class ArticlesController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function view(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $this->view->renderHtml('articles/view.php', ['article' => $article]);
    }

    public function edit(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $article->setName('Новое имя статьи');
        $article->setText('Новый текст статьи');
        $article->save();
    }

    public function create(): void
    {
        $article = new Article();
        $article->setName('Новое имя 1');
        $article->setText('Новый текст 2');
        $article->setAuthorId(1);
        $article->setCreatedAt(date('Y-m-d H:i:s'));
        $article->save();
    }
}