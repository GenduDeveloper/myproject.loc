<?php include_once __DIR__ . '/../header.php' ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <?php if (!empty($comments)): ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="media mb-4">
                            <div class="media-body">
                                <h6 class="mt-0"><?= $comment->getAuthorComment()->getNickname() ?></h6>
                                <?= htmlentities($comment->getComment()) ?><br>
                                <a style="width: 300px" href="/comments/<?= $comment->getId() ?>/edit"
                                   class="btn btn-warning">Изменить</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <strong style="text-align: center">Комментариев нет</strong>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php include_once __DIR__ . '/../footer.php' ?>