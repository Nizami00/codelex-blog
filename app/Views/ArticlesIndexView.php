</html>

<head>
    <link rel="stylesheet" type="text/css" href="/app/Views/MainPage.css">
</head>
<body>
<div class="header">
    <a href="/" class="logo">Articles</a>
    <div class="header-right">
        <a href="/">HOME</a>
        <a href="/articles/create">CREATE</a>
        <div id="indicator"></div>
    </div>
</div>

<hr class="rounded">
<div class="body"
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
    <b>Likes: <?php echo $article->likes(); ?> </b>
    <b>Dislikes: <?php echo $article->dislikes(); ?></b>
    <p>
    <div class="likes">
        <form action="/articles/<?= $article->id(); ?>/like" method="post">
            <button type="submit" value="1" name="like">Like</button>
        </form>
        <form action="/articles/<?= $article->id(); ?>/dislike" method="post">
            <button type="submit" value="1" name="dislike">Dislike</button>
        </form>
    </p>
    </div>

    <form action="/articles/<?= $article->id(); ?>" method="post">
        <p>
            <input type="hidden" name="_method" value="DELETE"/>
            <button type="submit">Delete</button>
        </p>
    </form>

    <hr>
<?php endforeach; ?>
</div>
</body>
</html>
