<main class="container">
    <section class="profil">
        <div class="profil__tab">
            <div class="profil__tab--wrapper">
                <img src="/build/images/avatar/avatar.png" alt="Avatar de <?= $user['username'] ?>"/>
                <hr/>
                <div class="profil__tab--infos">
                    <p class="username"><?= $user['username'] ?></p>
                    <p class="inscription">Membre depuis <?= \App\Util\DateHelper::yearSinceDate($user['inscriptionDate']) ?> an(s)</p>

                    <p class="books">Bibliothèque</p>
                    <p><i class="fa-solid fa-book"></i> 4 livres</p>
                </div>
                <a class="btn btn-reverse mt-3-2" href="#">
                    Écrire un message
                </a>
            </div>
        </div>

        <div class="profil__tab">
            test2
        </div>
    </section>
</main>
