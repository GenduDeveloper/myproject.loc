<?php

namespace MyProject\Controllers;
use MyProject\View\View;

class MainController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function main(): void
    {
        $articles = [
            ['title' => 'Заголовок статьи 1', 'text' => 'Текст статьи 1'],
            ['title' => 'Заголовок статьи 2', 'text' => 'Текст статьи 2'],
        ];
        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }

    public function sayHello(string $name): void
    {
        $this->view->renderHtml('main/hello.php', ['title' => 'Страница приветствия', 'name' => $name]);
    }
}