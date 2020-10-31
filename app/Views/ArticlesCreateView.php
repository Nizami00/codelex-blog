<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../app/Views/css/WriteArticles.css">
    <link rel="stylesheet" type="text/css" href="../app/Views/css/MainPage.css">
    <title>Create Article</title>
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
<h2>Create new Article</h2>

<div class="container">
    <form action="/articles/submitNewArticle" method="post">
        <div class="row">
            <div class="col-25">
                <label for="title">Title</label>
            </div>
            <div class="col-75">
                <input type="text" id="title" name="title"
                       placeholder="Your title.." required>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="subject">Content</label>
            </div>

            <div class="col-75">
                <input type="text" id="subject" name="subject"
                       placeholder="There should be your article" style="height:200px" required>
            </div>
        </div>
        <div class="row">
            <button type="submit">Submit</button>
        </div>
    </form>
</div>
</body>
</html>