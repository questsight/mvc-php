<?php
class Database
{
  public static function getConnection()
  {
    define( 'DB_HOST', 'localhost' );
    define( 'DB_USER', 'mysql' );
    define( 'DB_PASSWORD', 'mysql' );
    define( 'DB_NAME', 'test' );
    define( 'DB_CHARSET', 'utf8' );
    define( 'DB_COLLATION', 'utf8_general_ci' );
  }
}
?>
