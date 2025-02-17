<main>
    <?php
    include_once 'partials/section-discover.php'; ?>

    <section>
        <div class="section__wrapper">
            <h1 class="fs-36 pb-5">Les derniers livres ajoutés</h1>

            <div class="card__grid">
                <article class="card enlarge-link">
                    <img src="build/images/book-cover/cover1.png" alt="Cover livre n°1"/>
                    <div class="card__content">
                        <a href="#" class="card__content--title">Esther</a>
                        <p class="card__content--description">Alabaster</p>
                        <p class="card__content--seller">Vendu par : CamilleClubLit</p>
                    </div>
                </article>
                <article class="card enlarge-link">
                    <img src="build/images/book-cover/cover2.png" alt="Cover livre n°2"/>
                    <div class="card__content">
                        <a href="#" class="card__content--title">The Kinkfolk Table</a>
                        <p class="card__content--description">Nathan Williams</p>
                        <p class="card__content--seller">Vendu par : Nathalire</p>
                    </div>
                </article>
                <article class="card enlarge-link">
                    <img src="build/images/book-cover/cover3.png" alt="Cover livre n°3"/>
                    <div class="card__content">
                        <a href="#" class="card__content--title">Wabi Sabi</a>
                        <p class="card__content--description">Beth Kempton</p>
                        <p class="card__content--seller">Vendu par : Alexlecture</p>
                    </div>
                </article>
                <article class="card enlarge-link">
                    <img src="build/images/book-cover/cover4.png" alt="Cover livre n°4"/>
                    <div class="card__content">
                        <a href="#" class="card__content--title">Milk & honey</a>
                        <p class="card__content--description">Rupi Kaur</p>
                        <p class="card__content--seller">Vendu par : Hugo1990_12</p>
                    </div>
                </article>
            </div>

            <a href="/books" class="btn m-auto">
                Voir tous les livres
            </a>
        </div>
    </section>

    <section class="colored-background">
        <div class="section__wrapper">
            <h1 class="fs-36 pb-1-7">Comment ça marche ?</h1>
            <p class="section__subtitle">
                Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :
            </p>
            <div class="card__grid">
                <div class="card__text-only">
                    <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
                </div>
                <div class="card__text-only">
                    <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
                </div>
                <div class="card__text-only">
                    <p>Parcourez les livres disponibles chez d'autres membres.</p>
                </div>
                <div class="card__text-only">
                    <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
                </div>
            </div>

            <a href="/books" class="btn btn-reverse m-auto">
                Voir tous les livres
            </a>
        </div>
    </section>

    <section class="our-values colored-background">
        <img class="section__cover" src="build/images/clay-banks-4uH8rdyEbH4-unsplash.png" alt="Clay Banks">
        <div class="section__wrapper">
            <h1 class="our-values__title">Nos valeurs</h1>
            <p class="our-values__description">
                Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont
                ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous
                croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations
                enrichissantes.
            </p>
            <p class="our-values__description">
                Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.
            </p>
            <p class="our-values__description">
                Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se
                connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment
                sur les étagères.
            </p>
            <div class="our-values__signature">
                <p>L'équipe Tom Troc</p>
                <svg width="122" height="104" viewBox="0 0 122 104" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 96.2224V96.2224C2.29696 95.8216 6.2879 96.4842 7.64535 96.4785C34.2391 96.3656 77.2911 74.6923 96.4064 56.0062C109.127 40.7664 119.928 7.80529 85.8057 2.24352C65.0283 -1.1431 50.1873 26.7966 62.0601 33.1465C66.0177 35.2631 78.258 25.6112 65.0283 12.4034C51.7986 -0.804455 39.7279 0.126873 35.3463 2.24352C15.417 7.74679 2.27208 42.7137 71.8127 87.7558C96.4064 103.685 121 102.996 121 102.996"
                          stroke="#00AC66" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
    </section>
</main>
