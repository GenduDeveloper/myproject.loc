<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;

class MainController extends AbstractController
{
    public function main(): void
    {
        $this->page(1);
    }

    public function page(int $pageNum): void
    {
        $this->view->renderHtml('main/main.php',
            [
                'articles' => Article::getPage($pageNum, 5),
                'pagesCount' => Article::getPagesCount(5),
                'currentPageNum' => $pageNum,
            ]);
    }

}