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

    public function raw($query, array $bindings = Array(), $callable = null) {
        $stmt = $this->connection()->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute($bindings);

        if(is_callable($callable)) {
            call_user_func($callable, $stmt->rowCount() ,$stmt);
            return;
        }

        $results = $stmt->fetchAll();
        return $results ? $results : null;
    }
}
