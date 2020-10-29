<?php

namespace App\Controllers;

use App\Models\Comment;

class CommentController
{

    public function storeComment(array $vars)
    {
        $articleId = (int)$vars['id'];

        $commentQuery = query()
            ->insert('comments')
            ->values([
                'name' => '?',
                'comment' => '?',
                'article_id' => '?'
            ])
            ->setParameter(0, $_POST['name'])
            ->setParameter(1, $_POST['comment'])
            ->setParameter(2, $articleId);

        $commentQuery->execute();

        header('Location: /articles/' . $articleId);
    }

    public function deleteComment(array $vars)
    {

        $commentId = (int)$vars['idC'];
        $articleId = (int)$vars['id'];

        $commentQuery = query()
            ->delete('comments')
            ->where('id = :id')
            ->setParameter('id', $commentId)
            ->execute();

        header('Location: /articles/' . $articleId);
    }
}