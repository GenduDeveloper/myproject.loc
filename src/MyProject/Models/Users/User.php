<?php

namespace MyProject\Models\Users;

class User
{
    private string $nickname;

    public function getNickname(): string
    {
        return $this->nickname;
    }
}
