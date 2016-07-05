<?php
class Database {
    private $pdo;
    public function __construct($connectionInfo) {
        // $this->pdo = new PDO('mysql:host='.$connectionInfo['host'].';dbname='.$connectionInfo['db'],);
    }
}
