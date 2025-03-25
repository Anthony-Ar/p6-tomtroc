<main>
    <div class="container">
        <div class="breadcrumbs">
            <a href="/account" class="icon">
                <i class="fa-solid fa-arrow-left"></i>
                Retour
            </a>
        </div>

        <section class="add_book">
            <h1>Modifier les informations</h1>
            <form method="POST">
                <div class="form_group">
                    <div class="input_group">
                        <p class="form-label">Photo</p>
                        <img id="preview" class="preview" src="<?= $book['cover'] ?>" alt="<?= $book['title'] ?>">
                        <label class="right-label" for="cover">Modifier la photo</label>
                        <input class="sr-only" type="file" id="cover" name="cover" accept="image/png, image/jpeg"/>
                    </div>
                </div>

                <div class="form_group">
                    <div class="input_group">
                        <label for="title">Titre</label>
                        <input type="text" id="title" name="title" value="<?= $book['title'] ?>"/>
                    </div>
                    <div class="input_group">
                        <label for="author">Auteur•ice</label>
                        <input type="text" id="author" name="author" value="<?= $book['author'] ?>"/>
                    </div>
                    <div class="input_group">
                        <label for="description">Commentaire</label>
                        <textarea id="description" name="description" rows="20"><?= $book['description'] ?></textarea>
                    </div>
                    <div class="input_group">
                        <label for="state">Disponibilité</label>
                        <select id="state" name="state">
                            <option value="0" <?php $book['state'] ? print_r("selected") : null ?>>Disponible</option>
                            <option value="1" <?php !$book['state'] ? print_r("selected") : null ?>>Indisponible</option>
                        </select>
                    </div>
                    <button type="submit" id="add-book-submit" name="add-book-submit" class="btn">Valider</button>
                </div>
            </form>
        </section>
    </div>
</main>
<script src="/build/scripts/imagePreview.js" data-input="cover"></script>
