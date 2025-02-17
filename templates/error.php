<main>
    <div class="container">
        <div class="breadcrumbs">
            <a href="/" class="icon">
                <i class="fa-solid fa-arrow-left"></i>
                Revenir sur l'accueil de TomTroc
            </a>
        </div>

        <section>
            <h1>Oops... Une erreur est survenue.</h1>
            <div class="error_content">
                <h2>Erreur <?= $codeError ?></h2>
                <p class="error_description"><?= $messageError ?></p>
            </div>
        </section>
    </div>
</main>
