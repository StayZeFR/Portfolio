<nav class="navigation">
    <h1 class="title">BLANDIN Ilann</h1>
    <div class="menu">
        <ul>
            <li class="<?= $page == "FRONTOFFICE-HOME" ? "active" : "" ?>"><a href="<?= url_to("FRONTOFFICE-HOME") ?>">Accueil</a>
            </li>
            <li class="<?= $page == "FRONTOFFICE-PROFILE" ? "active" : "" ?>"><a href="<?= url_to("FRONTOFFICE-PROFILE") ?>">Profil</a></li>
            <li class="dropdown <?= $page == "FRONTOFFICE-PROJECTS" ? "active" : "" ?>">
                <a href="<?= url_to("FRONTOFFICE-PROJECTS") ?>">Projets</a>
                <ul class="dropdown-content">
                    <li><a class="dropdown-item" href="">Première année</a></li>
                    <hr>
                    <li><a class="dropdown-item" href="">Deuxième année</a></li>
                    <hr>
                    <li><a class="dropdown-item" href="">Stage</a></li>
                </ul>
            </li>
            <li class="<?= $page == "FRONTOFFICE-TECHWATCH" ? "active" : "" ?>"><a href="#">Veille technologique</a>
            </li>
            <li class="<?= $page == "FRONTOFFICE-CV" ? "active" : "" ?>"><a href="#">Curriculum vitae</a></li>
        </ul>
    </div>
</nav>