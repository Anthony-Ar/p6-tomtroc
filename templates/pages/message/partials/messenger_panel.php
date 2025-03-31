<?php
if ($discussions) {
    foreach ($discussions as $discussion) {
        ?>
        <div class="enlarge-link discussion <?php
        isset($id) && $id === $discussion['ownerId'] ? print 'active' : '' ?>">
            <img src="<?= $discussion['avatar'] ?>" alt="Avatar de <?= $discussion['username'] ?>">
            <div class="discussion__detail">
                <div class="discussion__detail--infos">
                    <a href="/messagerie/<?= $discussion['ownerId'] ?>"><?= $discussion['username'] ?></a>
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
