<?php

abstract class AbstractPdoManager {
    const host = 'localhost';
    const dbname = 'misc';
    const user = 'root';
    const pwd = 'root';
    protected $pdo;
    function __construct() {
        $this->pdo = new PDO('mysql:host=' . self::host . ';port=3306;dbname=' . self::dbname, self::user, self::pwd);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $this->pdo;
    }
}