<main class="container">
    <section class="profil">
        <div class="profil__tab left-tab">
            <div class="profil__tab--wrapper">
                <img src="<?= $user['avatar'] ?>" alt="Avatar de <?= $user['username'] ?>"/>
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
                <tr>
                    <td><img src="/build/images/book-cover/cover2.png" alt="1"></td>
                    <td>The Kinkfolk Table</td>
                    <td>Nathan Williams</td>
                    <td class="description">J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté p...</td>
                </tr>
                <tr>
                    <td><img src="/build/images/book-cover/cover2.png" alt="1"></td>
                    <td>The Kinkfolk Table</td>
                    <td>Nathan Williams</td>
                    <td class="description">J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté p...</td>
                </tr>
                <tr>
                    <td><img src="/build/images/book-cover/cover2.png" alt="1"></td>
                    <td>The Kinkfolk Table</td>
                    <td>Nathan Williams</td>
                    <td class="description">J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté p...</td>
                </tr>
                <tr>
                    <td><img src="/build/images/book-cover/cover2.png" alt="1"></td>
                    <td>The Kinkfolk Table</td>
                    <td>Nathan Williams</td>
                    <td class="description">J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté p...</td>
                </tr>
                </tbody>
            </table>
    </section>
</main>
