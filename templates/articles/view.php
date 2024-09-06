<?php include_once __DIR__ . '/../header.php' ?>

<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p><?= $article->getText() ?></p>
                <p class="post-meta"><strong>Автор статьи:</strong> <?= $article->getAuthor()->getNickname() ?>.</p>
            </div>
        </div>
    </div>
</article>
<hr>

<?php include_once __DIR__ . '/../footer.php' ?>


