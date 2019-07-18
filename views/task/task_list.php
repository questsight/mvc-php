<?php site_header();?>
        <section class="page mt-3">
          <div class="container">
            <div class="page-header mb-4">
              <h1 class="h2 page-title font-weight-normal text-center text-muted">Задачи</h1>
              <div class="page-subtitle lead text-center text-info"><a class="btn btn-success btn-sm" href="/task/add/">Добавить задачу</a></div>
            </div>
            <div class="page-content">
              <form action="" method="post">
                <div class="input-group mb-3">
                  <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-globe"></i></span></div>
                  <select class="form-control" name="sort" onchange="submit();">
                    <option value="desk" <?php if(!isset($_SESSION['sort']) || $_SESSION['sort'] == 'desk'){echo "selected"; }?>>Сначала новые</option>
                    <option value="alphabet-name" <?php if(isset($_SESSION['sort']) && $_SESSION['sort'] == 'alphabet-name'){echo "selected"; }?>>По алфавиту (имя пользователя)</option>
                    <option value="alphabet-email" <?php if(isset($_SESSION['sort']) && $_SESSION['sort'] == 'alphabet-email'){echo "selected"; }?>>По алфавиту (e-mail)</option>
                    <option value="done" <?php if(isset($_SESSION['sort']) && $_SESSION['sort'] == 'done'){echo "selected"; }?>>Сначала выполненные</option>
                    <option value="not-done" <?php if(isset($_SESSION['sort']) && $_SESSION['sort'] == 'not-done'){echo "selected"; }?>>Сначала не выполненые</option>
                  </select>
                </div>
              </form>
              <?php foreach ( $taskList as $taskItem => $taskList ) : ?>
              <div class="card mb-4">
                <div class="card-header">
                  <h3 class="card-title lead m-0">
                    <text-info><?php echo $taskList[ 'author' ]; ?>, <?php echo $taskList[ 'email' ]; if($taskList['status']==1){echo ", выполнено";} ?></text-info>
                  </h3>
                </div>
                <div class="card-body bg-light pt-2 pb-0">
                  <p><?php echo $taskList[ 'text' ]; ?></p>
                </div>
                <?php if(isset($_SESSION['user'])):?>
                <div class="card-footer"><a class="btn btn-info" href="task/<?php echo $taskList[ 'id' ]; ?>/edit">Изменить</a></div>
                <?php endif; ?>
              </div>
              <?php endforeach; ?>
            </div>
            <div class="page-footer">
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  <?php echo $pagination->get(); ?>
                </ul>
              </nav>
            </div>
          </div>
        </section>

<?php site_footer(); ?>
