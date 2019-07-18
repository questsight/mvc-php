<?php site_header(); ?>

        <section class="page mt-3">
          <div class="container">
            <div class="page-header mb-4">
              <h1 class="h2 page-title font-weight-normal text-center text-muted">Добавить задачу</h1>
            </div>
            <div class="page-content">
              <div class="card mt-5">
                <div class="card-body bg-light">
                  <form action="" method="post">
                    <div class="form-row">
                      <div class="col-md">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
                          <input class="form-control" type="text" placeholder="Name" required name="author">
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-envelope"></i></span></div>
                          <input class="form-control" type="email" placeholder="E-mail" required name="email">
                        </div>
                      </div>
                    </div>
                    <div class="input-group mb-3">
                      <textarea class="form-control" rows="5" placeholder="Task" name="text" required></textarea>
                    </div>
                    <input class="btn btn-info" type="submit" value="Добавить"  style="margin-right:10px;">
                    <a class="btn btn-info" href="/">Отмена</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>

<?php site_footer(); ?>