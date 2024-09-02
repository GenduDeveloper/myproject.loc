<?php include_once __DIR__ . '/../header.php' ?>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <?php foreach ($articles as $article): ?>
                <div class="post-preview">
                    <a href="post.html">
                        <h2 class="post-title">
                            <?= $article['title'] ?>
                        </h2>
                    </a>
                    <p>
                        <?= $article['text'] ?>
                    </p>
                    <p class="post-meta">Posted by <a href="#">Start Bootstrap</a> on September 24, 2014</p>
                </div>
                <hr>
            <?php endforeach; ?>
            <!-- Pager -->
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
