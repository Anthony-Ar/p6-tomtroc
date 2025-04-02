<div class="bg-header">
    <p class="container book-breadcrumbs">Nos livres > <?= $book['title'] ?></p>
</div>
<section class="show-book">
    <img src="<?= $book['cover'] ?>" alt="<?= $book['title'] ?>">

    <div class="show-book__details">
        <h1 class="fs-36"><?= $book['title'] ?></h1>
        <p class="show-book__details--author">par <?= $book['author'] ?></p>
        <hr/>

        <p class="show-book__details--subtitle">Description</p>
        <p class="show-book__details--description"><?= nl2br(htmlspecialchars($book['description'])) ?></p>

        <p class="show-book__details--subtitle">Propriétaire</p>
        <div class="show-book__details--user enlarge-link">
            <img src="<?= $book['avatar'] ?>" alt="Avatar de <?= $book['username'] ?>">
            <a href="/profil/<?= $book['ownerId'] ?>"><?= $book['username'] ?></a>
        </div>

        <a href="/messagerie/<?= $book['ownerId'] ?>" class="btn w-100 justify-content-center">Envoyer un message</a>
    </div>
</section>
