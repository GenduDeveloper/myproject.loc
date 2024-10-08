<?php

namespace MyProject\Cli;

use MyProject\Exceptions\CliException;

abstract class AbstractCommand
{
    private array $params;

    public function __construct(array $params)
    {
        $this->params = $params;
        $this->checkParams();
    }

    abstract public function execute();

    abstract protected function checkParams();

    protected function getParam(string $paramName): ?string
    {
        return $this->params[$paramName] ?? null;
    }

    protected function ensureParamExists(string $paramName): void
    {
        if (!isset($this->params[$paramName])) {
            throw new CliException('Параметр с именем "' . $paramName . '" не установлен.');
        }
    }
}
