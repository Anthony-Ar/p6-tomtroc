<main class="container">
    <section class="account">
        <h1>Mon compte</h1>
        <div class="profil">
            <div class="profil__tab">
                <div class="profil__tab--wrapper">
                    <img src="<?= $user['avatar'] ?>" alt="Avatar de <?= $user['username'] ?>"/>
                    <a href="#" class="change-avatar">modifier</a>
                    <hr/>
                    <div class="profil__tab--infos">
                        <p class="username"><?= $user['username'] ?></p>
                        <p class="inscription">Membre depuis <?= \App\Util\DateHelper::yearSinceDate(
                                $user['inscriptionDate']
                            ) ?> an(s)</p>

                        <p class="books">Bibliothèque</p>
                        <p><i class="fa-solid fa-book"></i> <?= count($books) ?> livre(s)</p>
                    </div>
                </div>
            </div>

            <div class="profil__tab">
                <div class="profil__tab--wrapper">
                    <form method="POST">
                        <div class="update-profil">
                            <p class="title">Vos informations personnelles</p>
                            <div class="form_group">
                                <div class="input_group">
                                    <label for="email">Adresse email</label>
                                    <input type="text" id="email" name="email"
                                           value="<?= \App\Service\SessionManager::get('user')['email'] ?>" required>
                                </div>

                                <div class="input_group">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" id="password" name="password">
                                </div>

                                <div class="input_group">
                                    <label for="username">Pseudo</label>
                                    <input type="text" id="username" name="username"
                                           value="<?= \App\Service\SessionManager::get('user')['username'] ?>" required>
                                </div>
                            </div>

                            <button type="submit" id="update-profil-submit" name="update-profil-submit"
                                    class="btn btn-reverse">Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="books-list">
            <thead>
            <tr>
                <th>Photo</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Description</th>
                <th>Disponibilité</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (count($books) === 0) { ?>
                <tr>
                    <td colspan="6" class="text-align-center">
                        Vous ne possédez pas encore de livre dans votre collection personnelle.
                    </td>
                </tr>
                <?php
            } else {
                foreach ($books as $book) { ?>
                    <tr>
                        <td><img src="<?= $book['cover'] ?>" alt="<?= $book['title'] ?>"></td>
                        <td><a href="/books/<?= $book['id'] ?>"><?= $book['title'] ?></a></td>
                        <td><?= $book['author'] ?></td>
                        <td class="description">
                            <?= \App\Util\TextTruncator::truncate($book['description']) ?>
                        </td>
                        <td><?php
                            if ($book['state']) { ?>
                                <div class="label label-green">
                                    disponible
                                </div><?php
                            } else { ?>
                                <div class="label label-red">
                                    non dispo.
                                </div><?php
                            } ?></td>
                        <td class="actions">
                            <a href="/book/update/<?= $book['id'] ?>" class="edit">Éditer</a>
                            <a
                                href="/book/delete/<?= $book['id'] ?>"
                                class="delete"
                                <?= \App\Util\ConfirmAction::askConfirmation('Confirmez la suppression du livre') ?>
                            >
                                Supprimer
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            } ?>
            </tbody>
        </table>
    </section>
</main>
