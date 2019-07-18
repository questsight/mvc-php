<?php site_header(); ?>

      <section class="page mt-3">
          <div class="container">
            <div class="page-header mb-4">
              <h1 class="h2 page-title font-weight-normal text-center text-muted">Изменить задачу</h1>
            </div>
            <div class="page-content">
              <div class="card mt-5">
                <div class="card-body bg-light">
                  <form action="" method="post">
                    <div class="custom-control custom-checkbox" style="margin-bottom:10px;">
                      <input class="custom-control-input" id="customCheck1" type="checkbox" name="status" <?php if($taskEdit[ 'status' ]==1){echo " checked";} ?>>
                      <label class="custom-control-label" for="customCheck1">Выполнено</label>
                    </div>
                    <div class="input-group mb-3">
                      <textarea class="form-control" rows="5" name="text"><?php echo $taskEdit[ 'text' ]; ?></textarea>
                    </div>
                    <button class="btn btn-info" type="submit" style="margin-right:10px;">Изменить</button>
                    <a class="btn btn-info" href="/">Отмена</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>


<?php site_footer(); ?>