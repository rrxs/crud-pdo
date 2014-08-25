<?php

class CRUD {
  /*
   * insert
   */

  public static function insert($table = "", $data = array()) {
    global $database;

    $sql = "INSERT INTO {$table}";
    $sql .= "(" . join(", ", array_keys($data)) . ") VALUES ";
    $sql .= "(:" . join(", :", array_keys($data)) . ")";

    $database->query($sql);

    foreach ($data as $key => $value) {
      $database->bind(":" . $key, $value);
    }

    return $database->execute();
  }

  /*
   * update
   */

  public static function update($table = "", $data = array(), $params = array()) {
    global $database;
    $attribute_pairs = array();

    foreach ($data as $key => $value) {
      $attribute_pairs_params[] = $key . "= :" . $key;
    }
    foreach ($params as $key => $value) {
      $attribute_pairs_condition[] = $key . "= :" . $key;
    }

    $sql = "UPDATE {$table}";
    $sql .= " SET " . join(", ", $attribute_pairs_params);
    $sql .= " WHERE " . join(" AND ", $attribute_pairs_condition);

    $database->query($sql);

    foreach ($data as $key => $value) {
      $database->bind(":" . $key, $value);
    }
    foreach ($params as $key => $value) {
      $database->bind(":" . $key, $value);
    }

    return $database->execute();
  }

  /*
   * DELETE
   */

  public static function delete($table = "", $params = array()) {
    global $database;

    foreach ($params as $key => $value) {
      $attribute_pairs_params[] = $key . "= :" . $key;
    }

    $sql = "DELETE FROM {$table}";
    $sql .= " WHERE " . join(" AND ", $attribute_pairs_params);

    $database->query($sql);

    foreach ($params as $key => $value) {
      $database->bind(":" . $key, $value);
    }

    return $database->execute();
  }

  /*
   * Retorna todos os dados de uma tabela
   */

  public static function find_all($table = "") {
    global $database;

    $database->query("SELECT * FROM {$table}");

    return $database->resultSet();
  }

  /*
   * Realiza uma query.
   * Exemplo:
   * $sql = "SELECT * FROM tabela WHERE cond1 = ? OR (cond2 = ? AND cond3 < ?)"
   * $params = array("valor cond1", "valor cond2", "valor cond3");
   * 
   */

  public static function query($sql, $params = array()) {
    global $database;

    $database->query($sql);

    for ($i = 0; $i < count($params); $i++) {
      $database->bind($i + 1, $params[$i]);
    }

    return $database->resultSet();
  }

  /*
   * Um select (SELECT * FROM tabela WHERE c1 = c1 AND c2 = c2 AND c3 = c3).
   * Exemplo:
   * $table = "tabela"
   * $params = array("cond1" => "valor cond1", "cond2" => "valor cond2")
   * 
   */

  public static function select($table, $params = array()) {
    global $database;

    $attribute_pairs = array();

    foreach ($params as $key => $value) {
      $attribute_pairs[] = $key . " = :" . $key;
    }
    $sql = "SELECT * FROM {$table}";
    $sql .= " WHERE " . join(" AND ", $attribute_pairs);

    $database->query($sql);

    foreach ($params as $key => $value) {
      $database->bind(":{$key}", $value);
    }

    return $database->resultSet();
  }

}
