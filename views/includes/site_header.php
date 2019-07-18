<!DOCTYPE html>
<html class="h-100">
  <?php site_head(); ?>
  <body class="bg-light h-100">
    <div class="site mx-auto d-flex flex-column h-100 w-100 position-relative">
      <header class="site-header header">
        <nav class="navbar">
          <?php if(!isset($_SESSION['user'])):?>
          <a class="btn btn-success btn-sm" href="user/login">Войти</a>
          <?php endif; ?>
        </nav>
      </header>
      <div class="site-content flex-grow-1 flex-shrink-0">
