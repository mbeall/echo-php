<?php
/**
 * Connect to database and execute SQL query
 *
 * @author Matt Beall <me@rams.colostate.edu>
 * @license MIT http://opensource.org/licenses/MIT
 * @since 0.0.1
 */
class edb {

  function connect( $dbuser = 'cmh', $dbpassword = 'cbt', $dbhost = 'buscissql\cisweb' ) {
    $dbuser = empty($dbuser) ? $this->dbuser : $dbuser;
    $dbpassword = empty($dbuser) ? $this->dbpassword : $dbpassword;
    $dbhost = empty($dbuser) ? $this->dbhost : $dbhost;

    $conn = new PDO('sqlsrv:Server='.$dbhost, $dbuser, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    return $conn;
  }

  function query( $query ) {

    $conn = $this->connect();

    try {

      $query = $conn->query($query);

      do {
        if ($query->columnCount() > 0) {
          $results = $query->fetchAll(PDO::FETCH_ASSOC);
        }
      }
      while ($query->nextRowset());

      $conn = null;

      return $results;
    }
    catch (PDOException $e) {
      $conn = null;
      die ('Query failed: ' . $e->getMessage());
    }

  }

  function select( $table, $columns = '*', $args = array() ) {

    /**
     * Default parameters for select statement
     *
     * @var string $where   Search condition for row
     * @var string $groupby Group by expression
     * @var string $having  Search condition for group
     * @var string $orderby Order expression
     * @var string $order   Ascending or descending (ASC or DESC)
     */
    $defaults = array(
      'where'   => '',
      'groupby' => '',
      'having'  => '',
      'orderby' => '',
      'order'   => 'ASC',
    );

    /**
     * Parse connection arguments
     */
    $args = array_replace( $defaults, $args );

    /**
     * Build the query
     */
    $query  = '';
    $query .= 'SELECT ' . $columns;
    $query .= ' FROM ' . $table;
    $query .= !empty($args->where)   ? ' WHERE '    . $args->where : '';
    $query .= !empty($args->groupby) ? ' GROUP BY ' . $args->groupby : '';
    $query .= !empty($args->having)  ? ' HAVING '   . $args->having : '';
    $query .= !empty($args->orderby) ? ' ORDER BY ' . $args->orderby . ' ' . $args->order : '';
    $query .= ';';

    /**
     * Execute the query
     */
    $results = $this->query($query);
    return $results;

  }

  function insert( $table, (array) $values ) {

    /**
     * Build the query
     */
    $query  = '';
    $query .= 'INSERT INTO ' . $table;
    $query .= ' VALUES ';

    foreach($values as $row) {
      $query .= '(';
      $query .= $row;
      $query .= ')';
    }

    $query .= ';';

    preg_replace($query, ')(', '), (');

    /**
     * Execute the query
     */
    $results = $this->query($query);
    return $results;

  }

  function update() {
  }

  function delete() {
  }

}
