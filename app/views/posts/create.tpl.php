<?php
/**
 * @var \wfm\Validator $validation
 */

require_once VIEWS . '/incs/header.php'
?>


    <main class="main py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Новый пост</h2>

                    <form action="/posts" method="post">
                        <div class="mb-3">
                            <label for="title" class="form-label"> Заголовок </label>
                            <input type="text" class="form-control" id="title" name="title"
                                   placeholder="Введите заголовок" value="<?= old('title') ?>">
                          <?= isset($validation) ? $validation->listErrors('title') : '' ?>

                        </div>
                        <div class="mb-3">
                            <label for="excerpt" class="form-label">Короткое описание</label>
                            <textarea class="form-control" id="excerpt" rows="2" name="excerpt"
                                      placeholder="Введите короткое описание"
                            ><?= old('excerpt') ?></textarea>
                          <?= isset($validation) ? $validation->listErrors('excerpt') : '' ?>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Полное описание</label>
                            <textarea class="form-control" id="content" rows="10" name="content"
                                      placeholder="Введите полное описание"
                            ><?= old('content') ?></textarea>
                          <?= isset($validation) ? $validation->listErrors('content') : '' ?>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="submit">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php require_once VIEWS . '/incs/footer.php' ?>