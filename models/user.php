<?php

class UserModel
{
  // Проверка логина
  public static function checkLogin( $login )
  {
    if ( strlen( $login ) >= 5 ) {
      return true;
    }
    return false;
  }

  // Проверка пароля
  public static function checkPassword( $password )
  {
    if ( strlen( $password ) >= 3 ) {
      return true;
    }
    return false;
  }

  // Поиск пользователя в БД
  public static function checkUserData( $login, $password )
  {
    //echo $_SESSION[ 'user' ];
    $database = Database::getConnection();
    $connection = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
    if ( $connection -> connect_error ) {
      die( 'При подключении к базе данных произошла ошибка: ' . $connection -> connect_error );
    }
    $connection -> set_charset( DB_CHARSET );

    $query = "SELECT * FROM user WHERE login = '$login' AND password = '$password'";
    $result = $connection -> query( $query );
    if ( !$result ) {
      die( 'При выполнении запроса к базе данных произошла ошибка: ' . $connection -> error );
    }
    $user = $result -> fetch_assoc();
    if ( $user ) {
      return $user[ 'id' ];
    }
    return false;
  }

  // Запоминание пользователя
  public static function authorization( $userID )
  {
    session_start();
    $_SESSION[ 'user' ] = $userID;
  }
}
?>
