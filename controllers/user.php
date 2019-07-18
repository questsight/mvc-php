<?php

// Подключение модели
require_once( ROOT . '/models/user.php' );

class UserController
{
  public function actionLogin()
  {
    $login = '';
    $password = '';
    if ( isset( $_REQUEST[ 'submit' ] ) ) {
      $login = $_REQUEST[ 'login' ];
      $password = $_REQUEST[ 'password' ];
      $errors = false;

      // Валидация полей
      if ( !UserModel::checkLogin( $login ) ) {
        $errors[] = 'Неправильный логин';
      }

      if ( !UserModel::checkPassword( $password ) ) {
        $errors[] = 'Пароль не должен быть короче 3 символов';
      }

      // Проверка пользователя
      $userID = UserModel::checkUserData( $login, $password );
      if ( $userID == false ) {
        $errors[] = 'Неправильный логин или пароль';
      } else {
        UserModel::authorization( $userID );
        header( "Location: /" );
      }
    }
    require_once( ROOT . '/views/common/login.php' );
    return true;
  }
}
?>
