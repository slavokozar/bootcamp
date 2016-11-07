<?php

class db 
{
  protected static $pdo = null;

  public static function pdo()
  {
    // if static::$pdo was not yet created (ie. connected to the db)
    if(static::$pdo===null) {

      // connect to the database
      // store the connection (PDO) into static::$pdo
      try {
        static::$pdo = new PDO(
          'mysql:dbname='.config::get('db_database').';host='.config::get('db_host').';charset='.config::get('db_charset', 'utf8'), //'mysql:dbname=database_name;host=locahost;charset=utf8',
          config::get('db_user'),
          config::get('db_pass')
        );
        static::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
          echo 'Connection failed: ' . $e->getMessage();
      }
    }

    return static::$pdo;
  }

  public static function query($sql)
  {
    $result = static::pdo()->query($sql);
    if($result === false) 
    {
      static::exitWithError();
    }
    return $result;
  }

  public static function execute($sql, $substitutions = array())
  {
    // get PDO connection object
    $pdo = static::pdo();

    // prepare a statement out of SQL
    $statement = $pdo->prepare($sql);

    // we run the query and keep the outcome (true or false)
    $outcome = $statement->execute($substitutions);

    if($outcome===false)
    {
      static::exitWithError();
    }

    return $statement;
  }

  protected function exitWithError()
  {
    echo '<h1>MySQL error:</h1>';
    var_dump(static::pdo()->errorInfo());
    exit();
  }
}