<?php
// Подключение модели
require_once( ROOT . '/models/task.php' );
class TaskController
{
  public function actionList($page)
  {
    $taskList = array();
    $taskList = TaskModel::getTaskList($page);
    $total = TaskModel::getCountTask();
    $pagination = new Pagination($total, $page, TaskModel::SHOW_BY_DEFAULT, '');
    require_once( ROOT . '/views/task/task_list.php' );
    return true;
  }
  public function actionAdd()
  {
    $taskAdd = TaskModel::getTaskAdd();
    require_once( ROOT . '/views/task/task_add.php' );
    return true;
  }
  public function actionEdit( $id )
  {
    $taskEdit = TaskModel::getTaskEdit( $id );
    require_once( ROOT . '/views/task/task_edit.php' );
    return true;
  }
}
?>