<?php

namespace MyProject\Controllers;

use MyProject\View\View;
use MyProject\Services\Db;
use MyProject\Models\Articles\Article;

class MainController
{
    private View $view;
    private Db $db;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->db = new Db();
    }

    public function main(): void
    {
        $articles = $this->db->query(
            'SELECT * FROM articles',
            [], Article::class);

        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }
}