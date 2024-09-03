<?php

namespace MyProject\Controllers;
use MyProject\View\View;
use MyProject\Services\Db;

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
        $articles = $this->db->query('SELECT * FROM users;');
        var_dump($articles);
        //$this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }

    public function sayHello(string $name): void
    {
        $this->view->renderHtml('main/hello.php', ['title' => 'Страница приветствия', 'name' => $name]);
    }
}