<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ArticlesNotFoundException;
use MyProject\Models\Articles\Article;

class MainController extends AbstractController
{
    public function main(): void
    {
        $articles = Article::findAll();

        if (!$articles) {
            throw new ArticlesNotFoundException('Не найдено ни одной статьи');
        }

        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }

}