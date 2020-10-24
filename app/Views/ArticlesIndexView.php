<h1>Articles</h1>

<?php foreach ($articles as $article): ?>
    <h3>
        <a href="/articles/<?php echo $article->id(); ?>">
            <?php echo $article->title(); ?>
        </a>
    </h3>
    <p><?php echo $article->content(); ?></p>
    <p>
        <small>
            <?php echo $article->createdAt(); ?>
        </small>
    </p>
    <form action="/articles/<?= $article->id(); ?>/delete" method="post">
        <p>
            <button type="submit" value="<?=$article->id(); ?>" name="delete">Delete</button>
        </p>
    </form>
<?php endforeach; ?>
