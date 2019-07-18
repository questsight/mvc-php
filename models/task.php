<?php
class TaskModel
{
  
  const SHOW_BY_DEFAULT = 3;

  // Метод возвращает список записей
  public static function getTaskList($page)
  {
    session_start();
    if($page<1){$page=1;}
    $limit = self::SHOW_BY_DEFAULT;
    $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
    $database = Database::getConnection();
    $connection = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
    if ( $connection -> connect_error ) {
      die( 'При подключении к базе данных произошла ошибка: ' . $connection -> connect_error );
    }
    
    $connection -> set_charset( DB_CHARSET );
    
    if(!isset($_SESSION['sort'])){
      $_SESSION['sort'] = 'desk';
    }
    if($_POST){
      $_SESSION['sort'] = $_REQUEST[ 'sort' ];
    }
    if($_SESSION['sort'] == "desk"){
        $sort = "id DESC";
    }
    if($_SESSION['sort'] == "alphabet-name"){
      $sort = "author";
    }
    if($_SESSION['sort'] == "alphabet-email"){
      $sort = "email";
    }
    if($_SESSION['sort'] == "done"){
      $sort = "status DESC";
    }
    if($_SESSION['sort'] == "not-done"){
      $sort = "status";
    }
    
    $query = "SELECT * FROM task ORDER BY " . $sort . " LIMIT ". $limit  ." OFFSET " .$offset;
    
    $result = $connection -> query( $query );
    if ( !$result ) {
      die( 'При выполнении запроса к базе данных произошла ошибка: ' . $connection -> error );
    }
    $taskList = array();
    $i = 0;
    while ( $row = $result -> fetch_assoc() ) {
      $taskList[ $i ][ 'id' ] = $row [ 'id' ];
      $taskList[ $i ][ 'status' ] = $row [ 'status' ];
      $taskList[ $i ][ 'author' ] = $row [ 'author' ];
      $taskList[ $i ][ 'email' ] = $row [ 'email' ];
      $taskList[ $i ][ 'text' ] = $row [ 'text' ];
      $i++;
    }
    
    $result -> close();
    $connection -> close();
    
    return $taskList;
  }
  
  public static function getCountTask()
  {
    $connection = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
    if ( $connection -> connect_error ) {
      die( 'При подключении к базе данных произошла ошибка: ' . $connection -> connect_error );
    }
    $connection -> set_charset( DB_CHARSET );
    $query = 'SELECT count(id) AS count FROM task';
    $result = $connection -> query( $query );
    $row = $result->fetch_assoc();
    
    $result -> close();
    $connection -> close();
    
    return $row['count'];
  }
  
  public static function getTaskAdd()
  {
    session_start();
    $database = Database::getConnection();
    $connection = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
    if ( $connection -> connect_error )
    {
      die( 'При подключении к базе данных произошла ошибка: ' . $connection -> connect_error );
    }

    $connection -> set_charset( DB_CHARSET );

    function sanitizeString( $var )
    {
      $var = stripslashes( $var );
      $var = htmlentities( $var, ENT_QUOTES, 'UTF-8' );
      $var = strip_tags( $var );
      return $var;
    }

    function sanitizeMySQL( $connection, $var )
    {
      $var = $connection -> real_escape_string( $_REQUEST[ $var ] );
      $var = sanitizeString( $var );
      return $var;
    }

    if ( isset( $_REQUEST[ 'author' ] ) && isset( $_REQUEST[ 'email' ]) && isset( $_REQUEST[ 'text' ] ))
    {
      $author = sanitizeMySQL( $connection, 'author' );
      $email = sanitizeMySQL( $connection, 'email' );
      $text = sanitizeMySQL( $connection, 'text' );

      $query = "INSERT INTO task ( author, email, text ) VALUES " . "( '$author', '$email', '$text' )";
      
      $result = $connection -> query( $query );
      if ( !$result )
      {
        die( 'При выполнении запроса к базе данных произошла ошибка: ' . $connection -> error );
      } else {
        header( "Location: /" );
      }

      $result -> close();
      $connection -> close();
    } 
  }
  
  public static function getTaskEdit( $id )
  {
    session_start();
    $database = Database::getConnection();
    $connection = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
    if ( $connection -> connect_error ) {
      die( 'При подключении к базе данных произошла ошибка: ' . $connection -> connect_error );
    }
    $connection -> set_charset( DB_CHARSET );
    $id = intval( $id );
    if(isset( $_REQUEST[ 'status' ] ) || isset( $_REQUEST[ 'text' ] ))
    {
      function sanitizeString( $var )
      {
        $var = stripslashes( $var );
        $var = htmlentities( $var, ENT_QUOTES, 'UTF-8' );
        $var = strip_tags( $var );
        return $var;
      }

      function sanitizeMySQL( $connection, $var )
      {
        $var = $connection -> real_escape_string( $_REQUEST[ $var ] );
        $var = sanitizeString( $var );
        return $var;
      }    
    
      if(isset( $_REQUEST[ 'status' ] )){
        $status = 1;
      } else {
        $status = null;
      }
      $query = "UPDATE task SET status = '$status' WHERE id='$id'";
      $result = $connection -> query( $query );
      if ( !$result )
      {
        die( 'При выполнении запроса к базе данных произошла ошибка: ' . $connection -> error );
      }
    
      if(isset( $_REQUEST[ 'text' ] )){
        $text = sanitizeMySQL( $connection, 'text' );
        $query = "UPDATE task SET text = '$text' WHERE id='$id'";
        $result = $connection -> query( $query );
        if ( !$result )
        {
          die( 'При выполнении запроса к базе данных произошла ошибка: ' . $connection -> error );
        }
      }

      header( "Location: /" ); 
    } else {
      $query = "SELECT * FROM task WHERE id = '$id'";
      $result = $connection -> query( $query );
      if ( !$result ) {
        die( 'При выполнении запроса к базе данных произошла ошибка: ' . $connection -> error );
      }
      $taskEdit = $result -> fetch_assoc();
      return $taskEdit;
      die( $taskEdit['specialization'] );
    }

    $result -> close();
    $connection -> close();
  }
}
?>
