<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/app/Views/WriteArticles.css">
</head>
<body>

<h2><?= $article->title(); ?></h2>
<p>Make Changes to Your Article</p>

<div class="container">
    <form action="/articles/<?= $article->id(); ?>/update" method="post">
        <input type="hidden" name="_method" value="PUT">
        <div class="row">
            <div class="col-25">
                <label for="title">Title</label>
            </div>
            <div class="col-75">
                <input type="text" id="title" name="title" value="<?= $article->title(); ?>"
                       placeholder="Your title..">
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="subject">Content</label>
            </div>

            <div class="col-75">
                <input type="text" id="subject" name="subject" value="<?= $article->content(); ?>"
                       placeholder="<?= $article->content(); ?>" style="height:200px">
            </div>
        </div>
        <div class="row">
            <button type="submit">Submit</button>
        </div>
    </form>
</div>

</body>
</html>