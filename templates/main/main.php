<?php include_once __DIR__ . '/../header.php' ?>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <?php foreach ($articles as $article): ?>
                <div class="post-preview">
                    <h2 class="post-title">
                        <a href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a>
                    </h2>
                    <p>
                        <?= $article->getText() ?>
                    </p>
                    <p class="post-meta">Опубликовано в <?= $article->getCreatedAt() ?></p>
                </div>
                <hr>
            <?php endforeach; ?>
            <ul class="pager">
                <li class="next">
                    <a href="#">Older Posts &rarr;</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<hr>

<?php include_once __DIR__ . '/../footer.php' ?>
