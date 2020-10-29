<?php

namespace App\Controllers;

use App\Models\{Article, Comment, Tag};

class ArticlesController
{
    private array $articles;

    public function index()
    {
        $articlesQuery = query()
            ->select('*')
            ->from('articles')
            ->orderBy('created_at', 'desc')
            ->execute()
            ->fetchAllAssociative();

        $articles = [];

        foreach ($articlesQuery as $article) {
            $articles[] = new Article(
                (int)$article['id'],
                $article['title'],
                $article['content'],
                $article['created_at'],
                $article['likes'],
                $article['dislikes']
            );
        }

        return require_once __DIR__ . '/../Views/ArticlesIndexView.php';
    }

    public function like(array $vars)
    {

        if (isset($_POST['like'])) {
            $like = $_POST['like'];
            $articlesQuery = query()
                ->update('articles')
                ->set('likes', "likes + {$like}")
                ->where('id = :id')
                ->setParameter('id', (int)$vars['id'])
                ->execute();
        }
        header('Location: /');
    }

    public function dislike(array $vars)
    {
        $dislike = $_POST['dislike'];

        $articlesQuery = query()
            ->update('articles')
            ->set('dislikes', "dislikes + {$dislike}")
            ->where('id = :id')
            ->setParameter('id', (int)$vars['id'])
            ->execute();

        header('Location: /');
    }

    public function delete(array $vars)
    {

        $articlesQuery = query()
            ->delete('articles')
            ->where('id = :id')
            ->setParameter('id', (int)$vars['id'])
            ->execute();

        header('Location: /');
    }

    public function edit(array $vars)
    {
        $articleQuery = query()
            ->select('*')
            ->from('articles')
            ->where('id = :id')
            ->setParameter('id', (int)$vars['id'])
            ->execute()
            ->fetchAssociative();

        $article = new Article(
            (int)$articleQuery['id'],
            $articleQuery['title'],
            $articleQuery['content'],
            $articleQuery['created_at'],
            $articleQuery['likes'],
            $articleQuery['dislikes']
        );

        return require_once __DIR__ . '/../Views/ArticlesEditView.php';
    }

    public function create()
    {
        return require_once __DIR__ . '/../Views/ArticlesCreateView.php';
    }

    public function submitNewArticle()
    {
        $articleQuery = query()
            ->insert('articles')
            ->values([
                'title' => '?',
                'content' => '?'
            ])
            ->setParameter(0, $_POST['title'])
            ->setParameter(1, $_POST['subject']);

        $articleQuery->execute();
        header('Location: /');
    }

    public function update(array $vars)
    {
        query()
            ->update('articles')
            ->set('title', ':title')
            ->set('content', ':subject')
            ->setParameters([
                'title' => $_POST['title'],
                'subject' => $_POST['subject']
            ])
            ->where('id = :id')
            ->setParameter('id', (int)$vars['id'])
            ->execute();

        header('Location: /articles/' . $vars['id']);
    }


    public function show(array $vars)
    {
        $articleQuery = query()
            ->select('*')
            ->from('articles')
            ->where('id = :id')
            ->setParameter('id', (int)$vars['id'])
            ->execute()
            ->fetchAssociative();

        $article = new Article(
            (int)$articleQuery['id'],
            $articleQuery['title'],
            $articleQuery['content'],
            $articleQuery['created_at'],
            $articleQuery['likes'],
            $articleQuery['dislikes']
        );

        $commentQuery = query()
            ->select('*')
            ->from('comments')
            ->where('article_id = :articleId')
            ->setParameter('articleId', (int)$vars['id'])
            ->orderBy('created_at', 'desc')
            ->execute()
            ->fetchAllAssociative();

        $comments = [];

        foreach ($commentQuery as $comment) {
            $comments[] = new Comment(
                (int)$comment['id'],
                $comment['name'],
                $comment['comment'],
                $comment['created_at'],
                $comment['article_id'],
            );
        }

        $tagQuery = query()
            ->select('tag.name', 'tag.id')
            ->from('tags', 'tag')
            ->join('tag', 'articles_tags','article_tag',
                'article_tag.tag_id = tag.id')
            ->where('article_tag.article_id = :article_id')
            ->setParameter('article_id', (int)$vars['id'])
            ->execute()
            ->fetchAllAssociative();

        $tags = [];

        foreach ($tagQuery as $tag) {
            $tags[] = new Tag(
                (int)$tag['id'],
                $tag['name']
            );
        }

        return require_once __DIR__ . '/../Views/ArticlesShowView.php';
    }
}