<?php require_once VIEWS . '/incs/header.php' ?>

<main class="main py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
              <?php foreach ($posts as $post): ?>
                  <div class="card mb-3">
                      <div class="card-body">
                          <h5 class="card-title">
                              <a href="posts/<?= $post['slug'] ?>">
                                <?= h($post['title']) ?>
                              </a>
                          </h5>
                          <p class="card-text"><?= $post['excerpt'] ?></p>
                          <a href="posts/<?= $post['slug'] ?>">Read more</a>
                      </div>
                  </div>
              <?php endforeach; ?>
            </div>
          <?php require_once VIEWS . '/incs/sidebar.php' ?>
        </div>

        <hr>
        <?= $pagination ?>


    </div>
</main>


<?php require_once VIEWS . '/incs/footer.php' ?>
