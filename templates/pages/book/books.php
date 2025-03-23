<section class="section__wrapper">
    <div class="books__header">
        <h1 class="fs-36">Nos livres à l'échange</h1>

        <form method="POST" class="books__header--search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <label for="search" class="sr-only">Rechercher un livre</label>
            <input type="text" name="search" id="search" placeholder="Rechercher un livre">
        </form>
    </div>
    <div class="card__grid">
        <?php
        if ($books && count($books) > 0) {
            foreach ($books as $book) { ?>
                <article class="card enlarge-link">
                    <img src="<?= $book['cover'] ?>" alt="<?= $book['title'] ?>"/>
                    <div class="card__content">
                        <a href="/books/<?= $book['id'] ?>" class="card__content--title"><?= $book['title'] ?></a>
                        <p class="card__content--description"><?= $book['author'] ?></p>
                        <p class="card__content--seller">Vendu par : <?= $book['username'] ?></p>
                    </div>
                    <?php
                    if (!$book['state']) { ?>
                        <div class="label label-red">
                            non dispo.
                        </div>
                    <?php } ?>
                </article>
                <?php
            }
        } else { ?>
            Aucun livre à afficher.
            <?php
        } ?>
    </div>
</section>
