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
        $articles = $this->db->query(
          'SELECT a.id, a.name, a.text, a.created_at, u.nickname
          FROM articles AS a 
          INNER JOIN users AS u ON u.id = a.author_id'
        );

        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }
}