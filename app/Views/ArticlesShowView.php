<a href="/">Back</a>
<h1><?php echo $article->title(); ?></h1>
<p><?php echo $article->content(); ?></p>
<p>
<form action="/articles/<?= $article->id(); ?>/edit" method="get">
    <small>
        <b><?php echo $article->createdAt(); ?></b>
    </small>
    <button type="submit" value="<?= $article->id(); ?>" name="edit"> Edit Article</button>
</form>
</p>

<?php foreach ($tags as $tag) : ?>


<small><?= $tag->name() ;?></small>

<?php endforeach; ?>
<hr>
<h3>Comments</h3>
<?php if (count($comments) > 0): ?>
    <?php foreach ($comments as $comment) : ?>
        <form action="/articles/<?= $article->id(); ?>/<?= $comment->id(); ?>/deleteComment" method="post">
            <p><?= $comment->name() . ': ' . $comment->comment(); ?>
                <input type="hidden" name="_method" value="DELETE"/>
                <button type="submit">X</button>
        </form>
        </p>
    <?php endforeach; ?>
<?php else : ?>
    <em>There are no comments</em>
<?php endif; ?>
<hr>
<form action="/articles/<?= $article->id(); ?>/comment" method="post">
    <input type="text" id="name" name="name"
           placeholder="Your name.."><br>
    <input type="text" id="subject" name="comment"
           placeholder="Enter you comment" style="height:50px"><br>
    <button type="submit">Submit</button>
</form>
<hr>