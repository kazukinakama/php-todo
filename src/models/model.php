<?php

namespace src\models;

use PDO;

class Model
{
    private $DB_HOST;
    private $DB_DATABASE;
    private $DB_USERNAME;
    private $DB_PASSWORD;

    protected $connection = null;

    protected function connect(): void
    {
        $this->DB_HOST = (string) getenv('DB_HOST');
        $this->DB_DATABASE = (string) getenv('DB_DATABASE');
        $this->DB_USERNAME = (string) getenv('DB_USERNAME');
        $this->DB_PASSWORD = (string) getenv('DB_PASSWORD');

        $connection = new PDO(
            "mysql:host=$this->DB_HOST;dbname=$this->DB_DATABASE",
            $this->DB_USERNAME,
            $this->DB_PASSWORD,
        );

        $this->connection = $connection;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
