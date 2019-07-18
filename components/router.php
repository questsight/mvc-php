<?php

class Router
{
  private $route;

  public function __construct()
  {
    $routePath = ROOT . '/config/routes.php';
    $this->route = include( $routePath );
  }

  /**
   * Returns request string
   */
  private function getURI()
  {
    if ( !empty( $_SERVER[ 'REQUEST_URI' ] ) ) {
      return trim( $_SERVER[ 'REQUEST_URI' ], '/' );
    }
  }

  public function run()
  {
    // Получить строку запроса
    $uri = $this->getURI();

    // Проверить наличие такого запроса в routes.php
    foreach ( $this->route as $uriPattern => $path ) {

      // Сравниваем $uriPattern и $uri
      if ( preg_match( "~$uriPattern~", $uri ) ) {
          
        // Получаем внутренний путь из внешнего согласно правилу.
        $internalRoute = preg_replace( "~$uriPattern~", $path, $uri );
                        
        // Определить контроллер, action, параметры

        $segments = explode( '/', $internalRoute );

        $firstSegments = array_shift( $segments );
        $controllerName = $firstSegments . 'Controller';
        $controllerName = ucfirst( $controllerName );

        $actionName = 'action' . ucfirst( array_shift( $segments ) );
                     
        $parameters = $segments;
        
        // Подключить файл класса-контроллера
        $controllerFile = ROOT . '/controllers/' . $firstSegments . '.php';

        if ( file_exists( $controllerFile ) ) {
          include_once( $controllerFile );
        }

        // Создать объект, вызвать метод (т.е. action)
        $controllerObject = new $controllerName;
        
        $result = call_user_func_array( array( $controllerObject, $actionName ), $parameters );
        
        if ( $result != null ) {
          break;
        }
      }
    }
  }

}

?>
