<?php site_header(); ?>

        <section class="page mt-3">
          <div class="container">
            <div class="page-header mb-4">
              <h1 class="h2 page-title font-weight-normal text-center text-muted">Войти</h1>
            </div>
            <div class="page-content">
              <div class="card mt-5">
                <div class="card-body bg-light">
                  <form action="" method="post">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend"><span class="input-group-text">  <i class="fas fa-user"></i></span></div>
                       <input class="form-control" type="text" placeholder="Логин" required name="login" value="<?php echo $login; ?>">
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-key"></i></span></div>
                      <input class="form-control" type="password" placeholder="Пароль" required name="password">
                    </div>
                    <input class="btn btn-info" type="submit" value="Войти" name="submit" style="margin-right:10px;">
                    <a class="btn btn-info" href="/">Отмена</a>
                    <?php if ( isset( $errors ) && is_array( $errors ) ) : ?>
                    <ul class="form__error">
                      <?php foreach ( $errors as $error ) : ?>
                      <li><?php echo $error; ?></li>
                      <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>

<?php site_footer(); ?>