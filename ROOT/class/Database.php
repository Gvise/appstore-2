<?php
class Database {
    private $pdo;

    public function __construct($connectionInfo) {
        try {
            $this->pdo = new PDO('mysql:host='.$connectionInfo['host'].';dbname='.$connectionInfo['db'],$connectionInfo['user'], $connectionInfo['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    public function connection() {
        return $this->pdo;
    }

    public function query($query, array $bindings = Array()) {
        try {
            $stmt = $this->connection()->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute($bindings);
        } catch (PDOException $e) {
            // echo 'ERROR: ' . $e->getMessage();
            return $e->getMessage();
        }

        if(!strstr($query, 'select')) {
            return ['affectedRows' => $stmt->rowCount(),'lastId' =>  $this->connection()->lastInsertID()];
        }

        $results = $stmt->fetchAll();
        return $results ? $results : null;
    }
}
