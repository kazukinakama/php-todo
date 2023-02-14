<?php

namespace src\models;

use PDO;
use PDOException;
use src\models\Model;

class Todo extends Model
{
    public function __construct()
    {
        $this->connect();
    }

    public function findMany(): array
    {
        $connection = $this->getConnection();
        $sql = 'SELECT * FROM todos';
        $statement = $connection->prepare($sql);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function findOne(int $id): array
    {
        $connection = $this->getConnection();
        $sql = 'SELECT * FROM todos WHERE id = :id';
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function create(): void
    {
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $sql = 'INSERT INTO todos (title, is_done, created_at, updated_at) VALUES(:title, :is_done, NOW(), NOW())';
            $statement = $connection->prepare($sql);
            $statement->bindValue(':title', 'created', PDO::PARAM_STR);
            $statement->bindValue(':is_done', 0, PDO::PARAM_BOOL);
            $statement->execute();
            $connection->commit();
        } catch(PDOException $Exception) {
            $connection->rollback();
        }
    }

    public function update(int $id): void
    {
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $sql = 'UPDATE todos SET title = :title, is_done = :is_done, updated_at = NOW() WHERE id = :id';
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->bindValue(':title', 'updated', PDO::PARAM_STR);
            $statement->bindValue(':is_done', 1, PDO::PARAM_BOOL);
            $statement->execute();
            $connection->commit();
        } catch(PDOException $Exception) {
            $connection->rollback();
        }
    }

    public function delete(int $id): void
    {
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $sql = 'DELETE FROM todos WHERE id = :id';
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $connection->commit();
        } catch(PDOException $Exception) {
            $connection->rollback();
        }
    }
}
