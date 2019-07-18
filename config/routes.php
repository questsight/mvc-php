<?php

return array(
  'user/login' => 'user/login',
  'task/add' => 'task/add',
  'task/([0-9]+)/edit' => 'task/edit/$1',
  'task/([0-9]+)' => 'task/list/$1',
  'task' => 'task/list/$1',
  '' => 'task/list/$1',
);

?>
