<main class="container">
    <section class="profil">
        <div class="profil__tab left-tab">
            <div class="profil__tab--wrapper">
                <img src="<?= $user['avatar'] ?>" alt="Avatar de <?= $user['username'] ?>"/>
                <hr/>
                <div class="profil__tab--infos">
                    <p class="username"><?= $user['username'] ?></p>
                    <p class="inscription">Membre depuis <?= \App\Util\DateHelper::yearSinceDate(
                            $user['inscriptionDate']
                        ) ?> an(s)</p>

                    <p class="books">Bibliothèque</p>
                    <p><i class="fa-solid fa-book"></i> <?= count($books) ?> livre(s)</p>
                </div>
                <a class="btn btn-reverse mt-3-2" href="#">
                    Écrire un message
                </a>
            </div>
        </div>

        <table>
            <thead>
            <tr>
                <th>Photo</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (count($books) === 0) { ?>
                <tr>
                    <td colspan="4" class="text-align-center">Cet utilisateur ne possède pas encore de livres dans sa
                        collection personnelle.
                    </td>
                </tr>
            <?php
            } else {
                foreach ($books as $book) { ?>
                    <tr>
                        <td><img src="<?= $book['cover'] ?>" alt="<?= $book['title'] ?>"></td>
                        <td><?= $book['title'] ?></td>
                        <td><?= $book['author'] ?></td>
                        <td class="description">
                            <?= \App\Util\TextTruncator::truncate($book['description']) ?>
                        </td>
                    </tr>
                <?php
                }
            } ?>
            </tbody>
        </table>
    </section>
</main>
