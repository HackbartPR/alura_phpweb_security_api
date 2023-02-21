<?php require_once __DIR__ . '/header.php'; ?>

    <ul class="videos__container" alt="videos alura">
        <?php foreach ($videoList as $video) : ?>
            <li class="videos__item">
                <?php if (!empty($video->image_path())): ?>
                    <a href="<?= $video->url ?>">
                        <img src="<?= "/img/uploads/{$video->image_path()}" ?>" alt="">
                    </a>
                <?php else: ?>
                    <iframe width="100%" height="72%" src="<?= $video->url ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?php endif; ?>    
                <div class="descricao-video">
                    <img src="./img/logo.png" alt="logo canal alura">
                    <h3><?= $video->title ?></h3>
                    <div class="acoes-video">
                        <a href="/editar?id=<?= $video->id() ?>">Editar</a>
                        <a href="/remover?id=<?= $video->id() ?>">Excluir</a>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

<?php require_once __DIR__ . '/footer.php';