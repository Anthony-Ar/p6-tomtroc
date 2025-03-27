<main class="container">
    <section class="messenger">
        <div class="messenger__panel">
            <h1>Messagerie</h1>

            <?php include_once 'partials/messenger_panel.php' ?>
        </div>

        <div class="messenger__discussion">
            <div class="messenger__discussion--head">
                <img src="<?= $profil['avatar'] ?>" alt="Avatar de <?= $profil['username'] ?>">
                <p><?= $profil['username'] ?></p>
            </div>
            <div class="messenger__discussion--messages">
                <?php
                if ($messages) {
                foreach ($messages as $message) {
                if ($message['ownerId'] !== \App\Service\SessionManager::get('user')['id']) {
                ?>
                <div class="message-from">
                    <div class="infos">
                        <img src="<?= $profil['avatar'] ?>" alt="Avatar de <?= $profil['username'] ?>">
                        <p class="date">
                            <?= new DateTime($message['date'])->format('d.m H:i') ?>
                        </p>
                    </div>
                    <?php
                    } else {
                    ?>
                    <div class="message-to">
                        <p class="date">
                            <?= new DateTime($message['date'])->format('d.m H:i') ?>
                        </p>
                        <?php
                        } ?>
                        <p class="message">
                            <?= nl2br(htmlspecialchars($message['content'])) ?>
                        </p>
                    </div>
                    <?php
                    }
                    } ?>
                </div>
                <div class="messenger__discussion--sending">
                    <form method="POST">
                        <div class="input_group">
                            <label for="content" class="sr-only">Message</label>
                            <input type="text" name="content" id="content" placeholder="Tapez votre message ici">
                        </div>
                        <input type="submit" name="send-message" id="send-message" class="btn" value="Envoyer">
                    </form>
                </div>
            </div>
    </section>
</main>
