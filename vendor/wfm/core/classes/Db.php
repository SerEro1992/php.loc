<?php

namespace wfm;

final class Db
{
  private $pdo;
  private \PDOStatement $stmt;

  private static $instance = null;

  private function __construct()
  {

  }

  private function __clone()
  {

  }

  public function __wakeup()
  {

  }

  public static function getInstance()
  {
    if (!self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function getConnection(array $db_config)
  {
    if ($this->pdo instanceof \PDO) {
      return $this;
    }
    $dsn = "mysql:host={$db_config['host']};dbname={$db_config['database']};charset={$db_config['charset']}";
    try {
      $this->pdo = new \PDO($dsn, $db_config['username'], $db_config['password'], $db_config['options']);
      return $this;
    } catch (\PDOException $e) {
      abort(500);
    }
  }

  public function query($query, $params = [])
  {
    try {
      $this->stmt = $this->pdo->prepare($query);
      $this->stmt->execute($params);
    } catch (\PDOException $e) {
      error_log("[" . date('Y-m-d H:i:s') . "] Ошибка БД: " . $e->getMessage() . PHP_EOL, 3, ERRORS_LOG_FILE);
      return false;
    }
    return $this;
  }

  public function findAll()
  {
    return $this->stmt->fetchAll();
  }

  public function find()
  {
    return $this->stmt->fetch();
  }

  public function findOrFail()
  {
    $result = $this->find();
    if (!$result) {
      abort(404);
    }
    return $result;
  }

  public function rowCount()
  {
    return $this->stmt->rowCount();
  }

  public function getColumn()
  {
    return $this->stmt->fetchColumn();
  }

  public function getInsertId()
  {
    return $this->pdo->lastInsertId();
  }

}