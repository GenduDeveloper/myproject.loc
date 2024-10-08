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
                        <?= htmlentities($article->getShortText()) ?><br>
                    </p>
                    <p class="post-meta">Опубликовано в <?= $article->getCreatedAt() ?></p>
                </div>
                <a style="width: 300px" href="/articles/<?= $article->getId() ?>"
                   class="btn btn-primary">Читать полностью &rarr;</a>
                <hr>
            <?php endforeach; ?>
            <ul class="pager">
                <?php for ($pageNum = 1; $pageNum <= $pagesCount; $pageNum++): ?>
                    <?php if ($currentPageNum === $pageNum): ?>
                        <b><?= $pageNum ?></b>
                    <?php else: ?>
                        <a href="/<?= $pageNum === 1 ? '' : $pageNum ?>"><?= $pageNum ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
</div>
<hr>

<?php include_once __DIR__ . '/../footer.php' ?>
