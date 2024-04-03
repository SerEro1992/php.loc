<?php require_once VIEWS . '/incs/header.php' ?>

    <main class="main py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h2> Регистрация </h2>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Ваше имя</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ваше имя"
                                   value="<?= old('name') ?>">
                          <?= isset($validation) ? $validation->listErrors('name') : '' ?>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Ваш email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ваш email"
                                   value="<?= old('email') ?>">
                          <?= isset($validation) ? $validation->listErrors('email') : '' ?>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Ваш пароль</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Ваш пароль"
                                   value="<?= old('password') ?>">
                          <?= isset($validation) ? $validation->listErrors('password') : '' ?>
                        </div>

                        <div class="mb-3">
                            <label for="avatar" class="form-label">Ваш аватар</label>
                            <input type="file" class="form-control" id="avatar" name="avatar">
                          <?= isset($validation) ? $validation->listErrors('avatar') : '' ?>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Создать аккаунт</button>
                        </div>

                    </form>


                </div>


            </div>
        </div>
    </main>

<?php require_once VIEWS . '/incs/footer.php' ?>