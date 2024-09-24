<?php

namespace MyProject\Models\Comments;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;
use MyProject\Services\Db;

class Comment extends ActiveRecordEntity
{
    protected int $authorId;
    protected int $articleId;
    protected ?string $comment;
    protected ?string $createdAt = null;

    protected static function getTableName(): string
    {
        return 'comments';
    }

    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function getAuthorComment(): User
    {
        return User::getById($this->authorId);
    }

    public function setArticleId(int $articleId): void
    {
        $this->articleId = $articleId;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param int $articleId
     * @return array
     */
    public static function findCommentsByArticleId(int $articleId): array
    {
        $db = Db::getInstance();
        return $db->query
        (
            'SELECT * FROM ' . self::getTableName() . ' WHERE article_id = :articleId ORDER BY id DESC',
            [':articleId' => $articleId], static::class
        );
    }

    public static function addComment(array $userData, int $authorId, int $articleId): Comment
    {
        if (empty($userData['comment'])) {
            throw new InvalidArgumentException('Комментарий был не передан');
        }

        $comment = new Comment();
        $comment->setAuthorId($authorId);
        $comment->setArticleId($articleId);
        $comment->setComment($userData['comment']);
        $comment->save();
        return $comment;
    }

}
