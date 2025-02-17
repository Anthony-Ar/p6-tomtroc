<header>
    <div class="container">
        <a href="/">
            <img src="./build/images/logo.svg" alt="TomTroc">
        </a>
        <div class="links">
            <nav>
                <ul>
                    <li>
                        <a href="/">Accueil</a>
                    </li>
                    <li>
                        <a href="/books">Nos livres à l'échange</a>
                    </li>
                </ul>
            </nav>
            <div class="user_menu">
                <ul>
                    <?php if(\App\Util\ConnectionChecker::isConnected()) { ?>
                    <li>
                        <a href="#" class="icon">
                            <i class="fa-regular fa-comment"></i>
                            Messagerie
                            <span class="badge">1</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="icon">
                            <i class="fa-regular fa-user"></i>
                            Mon compte
                        </a>
                    </li>
                    <li>
                        <a href="/logout" class="icon">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                            Déconnexion
                        </a>
                    </li>
                    <?php } else { ?>
                    <li>
                        <a href="/registration">
                            Inscription
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Connexion
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</header>
