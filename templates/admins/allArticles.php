<?php include_once __DIR__ . '/../header.php' ?>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <?php foreach ($articles as $article): ?>
                <div class="post-preview">
                    <h2 class="post-title">
                        <a href="/articles/<?= $article->getId() ?>"><?= htmlentities($article->getName()) ?></a>
                    </h2>
                    <p>
                        <?= htmlentities($article->getShortText()) ?>
                    </p>
                    <p class="post-meta">Опубликовано в <?= $article->getCreatedAt() ?></p>
                </div>
                <a style="width: 300px" href="/articles/<?= $article->getId() ?>/edit"
                   class="btn btn-primary">Редактировать</a>
                <br><br>
                <a style="width: 300px" href="/admin/<?= $article->getId() ?>/comments"
                   class="btn btn-warning">Комментарии к статье</a>
                <hr>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<hr>

<?php include_once __DIR__ . '/../footer.php' ?>

