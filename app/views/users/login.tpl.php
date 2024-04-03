<?php require_once VIEWS . '/incs/header.php' ?>

    <main class="main py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h2> Вход в систему </h2>
                    <form action="" method="post">

                        <div class="mb-3">
                            <label for="email" class="form-label">Ваш email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ваш email"
                            >
                          <?= isset($validation) ? $validation->listErrors('email') : '' ?>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Ваш пароль</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Ваш пароль"
                            >
                          <?= isset($validation) ? $validation->listErrors('password') : '' ?>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Войти в  аккаунт</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>

<?php require_once VIEWS . '/incs/footer.php' ?>