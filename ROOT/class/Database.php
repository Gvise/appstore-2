<?php
class Database {
    private $pdo;
    private $fetchmode;

    public function __construct($connectionInfo, $fetchmode) {
        try {
            $this->pdo = new PDO('mysql:host='.$connectionInfo['host'].';dbname='.$connectionInfo['db'],$connectionInfo['user'], $connectionInfo['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->fetchmode = $fetchmode;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function connection() {
        return $this->pdo;
    }

    public function query($query, array $bindings = Array()) {
        try {
            $stmt = $this->connection()->prepare($query);
            $stmt->setFetchMode($this->fetchmode);
            $stmt->execute($bindings);
        } catch (PDOException $e) {
            throw $e;
        }

        if(!strstr($query, 'select')) {
            $result = new stdClass();
            $result->affectedRows = $stmt->rowCount();
            $result->lastId = $this->connection()->lastInsertID();
            return $result;
        }

        $results = $stmt->fetchAll();
        return $results ? $results : null;
    }

    public function exec(Query $query) {
        try {
            $stmt = $this->connection()->prepare($query->queryString());
            $stmt->setFetchMode($this->fetchmode);
            $stmt->execute($query->bindings());
        } catch (PDOException $e) {
            throw $e;
        }

        if(!strstr($query->queryString(), 'select')) {
            $result = new stdClass();
            $result->affectedRows = $stmt->rowCount();
            $result->lastId = $this->connection()->lastInsertID();
            return $result;
        }

        $results = $stmt->fetchAll();
        return $results ? $results : null;
    }
}
