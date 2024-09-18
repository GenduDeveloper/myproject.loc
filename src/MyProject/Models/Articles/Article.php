<?php

namespace MyProject\Models\Articles;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;

class Article extends ActiveRecordEntity
{
    protected string $name;
    protected string $text;
    protected int $authorId;
    protected ?string $createdAt = null;

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    public function setAuthor(User $author): void
    {
        $this->authorId = $author->getId();
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    protected static function getTableName(): string
    {
        return 'articles';
    }

    public static function createNewArticle(array $field, User $author): Article
    {
        if (empty($field['name'])) {
            throw new InvalidArgumentException('Не передано имя статьи');
        }

        if (empty($field['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        $article = new Article();
        $article->setName($field['name']);
        $article->setText($field['text']);
        $article->setAuthor($author);

        $article->save();
        return $article;
    }

    public function editArticleById(array $field): Article
    {
        if (empty($field['name'])) {
            throw new InvalidArgumentException('Не передано новое имя статьи');
        }

        if (empty($field['text'])) {
            throw new InvalidArgumentException('Не передан новый текст статьи');
        }

        $this->setName($field['name']);
        $this->setText($field['text']);

        $this->save();
        return $this;
    }
}