<?php

namespace MyProject\Services;

use MyProject\Exceptions\DbException;

class Db
{
    private static ?Db $instance = null;
    private \PDO $pdo;

    /**
     * @throws DbException
     */
    private function __construct()
    {

        $dbOptions = (require __DIR__ . '/../../settings.php')['db'];

        try {
            $this->pdo = new \PDO(
                'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
                $dbOptions['user'],
                $dbOptions['password']
            );
            $this->pdo->exec("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_general_ci'");
        } catch (\PDOException $e) {
            throw new DbException('Ошибка при подключении к базе данных: ' . $e->getMessage());
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getLastInsertId(): int
    {
        return (int)$this->pdo->lastInsertId();
    }

    public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array
    {
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($params);

        if ($result === false) {
            return null;
        }

        return $stmt->fetchAll(\PDO::FETCH_CLASS, $className);
    }
}
