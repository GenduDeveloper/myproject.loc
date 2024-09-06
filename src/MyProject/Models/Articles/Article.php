<?php

namespace MyProject\Models\Articles;

class Article
{
    private int $id;
    private ?int $authorId = null;
    private string $name;
    private string $text;
    private ?string $createdAt = null;

    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthorId(): ?int
    {
        return $this->authorId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

}