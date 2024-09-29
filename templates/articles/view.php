<?php include_once __DIR__ . '/../header.php' ?>

    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <p><?= strip_tags($article->getParsedText(), '<p><strong><em>') ?></p>
                    <p class="post-meta"><strong>Автор статьи:</strong> <?= $article->getAuthor()->getNickname() ?>.</p>
                    <?php if ($user !== null && $user->isAdmin()): ?>
                        <a style="width: 300px" href="/articles/<?= $article->getId() ?>/edit"
                           class="btn btn-primary">Редактировать</a><br><br>
                    <?php endif; ?>
                    <br><br>
                    <?php if (!empty($error)): ?>
                        <div class="error-container">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($user !== null): ?>
                        <form action="/articles/<?= $article->getId() ?>/comments" method="post">
                            <div class="form-group">
                                <label for="comment"></label>
                                <textarea class="form-control" id="comment" name="comment" rows="3"
                                          placeholder="Ваш комментарий..."></textarea>
                            </div>
                            <button type="submit" style="width: 300px" class="btn btn-primary">Добавить комментарий
                            </button>
                        </form>
                    <?php else: ?>
                        <p>Для <strong>добавления</strong> комментариев нужно <a href="/users/login">авторизоваться</a>
                            или <a
                                    href="/users/register">зарегистрироваться</a>.</p>
                    <?php endif; ?>
                    <hr class="hr-solid">
                    <?php if (!empty($comments)): ?>
                        <?php foreach ($comments as $comment): ?>
                            <div class="media mb-4">
                                <div class="media-body">
                                    <h6 class="mt-0"><?= $comment->getAuthorComment()->getNickname() ?></h6>
                                    <?= htmlentities($comment->getComment()) ?>
                                    <?php if ($user !== null): ?>
                                        <?php if ($user->getId() === $comment->getAuthorId() || $user->isAdmin()): ?>
                                            <a style="width: 300px" href="/comments/<?= $comment->getId() ?>/edit"
                                               class="btn btn-warning">Изменить</a><br>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Комментариев нет</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </article>
    <hr>

<?php include_once __DIR__ . '/../footer.php' ?>