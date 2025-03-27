<main class="container">
    <section class="messenger">
        <div class="messenger__panel">
            <h1>Messagerie</h1>

            <?php
            if ($discussions) {
                foreach ($discussions as $discussion) {
                    ?>
                    <div class="discussion <?php
                    isset($id) && $id === $discussion['ownerId'] ? print 'active' : '' ?>">
                        <img src="<?= $discussion['avatar'] ?>" alt="Avatar de <?= $discussion['username'] ?>">
                        <div class="discussion__detail">
                            <div class="discussion__detail--infos">
                                <p><?= $discussion['username'] ?></p>
                                <p class="date">
                                    <?= \App\Util\DateHelper::showHoursOrDays($discussion['date']) ?>
                                </p>
                            </div>
                            <p class="description">
                                <?= \App\Util\TextTruncator::truncate(
                                    htmlspecialchars($discussion['content']),
                                    27
                                ) ?>
                            </p>
                        </div>
                    </div>
                    <?php
                }
            } ?>
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
            <form action="POST">
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
