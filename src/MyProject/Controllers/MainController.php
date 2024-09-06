<?php

namespace MyProject\Controllers;

use MyProject\View\View;
use MyProject\Models\Articles\Article;

class MainController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function main(): void
    {
        $articles = Article::findAll();
        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }

}