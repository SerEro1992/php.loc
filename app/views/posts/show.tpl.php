<?php require_once VIEWS . '/incs/header.php' ?>

    <main class="main py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2><?= h($post['title']) ?></h2>
                    <p><?= $post['content'] ?></p>

                    <form action="/posts" method="post">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="id" value="<?= $post['id'] ?>">
                        <input type="submit" class="btn btn-link" value="Delete">
                    </form>

                </div>


            </div>
        </div>
    </main>

<?php require_once VIEWS . '/incs/footer.php' ?>