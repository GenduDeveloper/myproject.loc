<?php

namespace MyProject\Models;

use MyProject\Services\Db;

abstract class ActiveRecordEntity
{
    protected ?int $id = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    private function mapPropertiesToDbFormat(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();

        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;
        }

        return $mappedProperties;
    }

    public function save(): void
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($this->id !== null) {
            $this->update($mappedProperties);
        } else {
            $this->insert($mappedProperties);
        }
    }

    public function update(array $mappedProperties): void
    {
        $column2params = [];
        $params2values = [];
        $index = 1;
        foreach ($mappedProperties as $column => $value) {
            $param = ':param' . $index;
            $column2params[] = $column . ' = ' . $param;
            $params2values[$param] = $value;
            $index++;
        }
        $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $column2params) . ' WHERE id = ' . $this->id;
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
    }

    public function insert(array $mappedProperties): void
    {
        $filteredProperties = array_filter($mappedProperties);

        $columns = [];
        $preparedParams = [];
        $params2values = [];
        foreach ($filteredProperties as $column => $value) {
            $columns[] = $column;
            $param = ':' . $column;
            $preparedParams[] = $param;
            $params2values[$param] = $value;
        }
        $sql = 'INSERT INTO ' . static::getTableName() . ' (' . implode(', ', $columns) .
            ')' . ' VALUES ' . '(' . implode(', ', $preparedParams) . ')';
        $db = DB::getInstance();
        $db->query($sql, $params2values, static::class);
        $this->id = $db->getLastInsertId();
        $this->refresh();
    }

    public function delete(): void
    {
        $sql = 'DELETE FROM ' . static::getTableName() . ' WHERE id = :id';
        $db = Db::getInstance();
        $db->query($sql, [':id' => $this->id], static::class);
        $this->id = null;
    }

    private function refresh(): void
    {
        $objectFromDb = static::getById($this->id);
        foreach ($objectFromDb as $property => $value) {
            $this->$property = $value;
        }
    }

    /**
     * @param int $id
     * @return static|null
     */
    public static function getById(int $id): ?self
    {
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM ' . static::getTableName() . ' WHERE id = :id',
            [':id' => $id], static::class);

        return $entities ? $entities[0] : null;
    }

    public static function findAll(): array
    {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM ' . static::getTableName(), [], static::class);
    }

    abstract protected static function getTableName(): string;

}