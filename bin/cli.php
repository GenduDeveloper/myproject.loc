<?php

try {
    unset($argv[0]);

    require __DIR__ . '/../vendor/autoload.php';

    $className = '\\MyProject\\Cli\\' . array_shift($argv);
    if (!class_exists($className)) {
        throw new \MyProject\Exceptions\CliException('Класс "' . $className . '" не найден.');
    }

    if (!is_subclass_of($className, \MyProject\Cli\AbstractCommand::class)) {
        throw new \MyProject\Exceptions\CliException('Класс "' . $className . '" не наследует класс AbstractCommand');
    }

    $params = [];
    foreach ($argv as $argument) {
        preg_match('/^-(.+)=(.+)$/', $argument, $matches);
        if (!empty($matches)) {
            $paramName = $matches[1];
            $paramValue = $matches[2];

            $params[$paramName] = $paramValue;
        }
    }

    $class = new $className($params);
    $class->execute();
} catch (\MyProject\Exceptions\CliException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}

