<?php

class Database extends config {

  private $_dbh; // conexão
  private $_error;
  private $_stmt;

  /*
   * Conecta com o banco de dados
   */

  public function __construct() {
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
    $options = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    try {
      $this->_dbh = new PDO($dsn, $this->user, $this->pass, $options);
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  }

  /*
   * Prepara a query
   */

  public function query($query) {
    $this->_stmt = $this->_dbh->prepare($query);
  }

  /*
   * "'Binda' os parâmetro"
   */

  public function bind($param, $value, $type = null) {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
    }
    $this->_stmt->bindValue($param, $value, $type);
  }

  /*
   * Executa a query
   */

  public function execute() {
    try {
      return $this->_stmt->execute();
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  }

  /*
   * Retorna todas as linhas do resultado
   */

  public function resultset() {
    $this->execute();
    return $this->_stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function rowCount() {
    return $this->_stmt->rowCount();
  }

  public function lastInsertId() {
    return $this->_dbh->lastInsertId();
  }
  
  /*
   * Usada para ver se os parâmetros foram 'bindados'
   */
  public function debugParams() {
    return $this->_stmt->debugDumpParams();
  }

}
