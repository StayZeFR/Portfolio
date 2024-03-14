<?= $this->extend("frontoffice/portfolio/_pattern") ?>

<?= $this->section("assets") ?>
    <link rel="stylesheet" href="<?= base_url("assets/css/frontoffice/portfolio/home.css") ?>">
    <script src="<?= base_url("assets/libs/tsparticles/tsparticles.js") ?>"></script>
    <script src="<?= base_url("assets/js/frontoffice/portfolio/home.js") ?>"></script>
<?= $this->endSection() ?>

<?= $this->section("main") ?>
    <div id="container">
        <div id="filter">
            <div id="filter-content">
                <h1>BIENVENUE</h1>
                <h2>Je m'appelle <b><?= (strtoupper(session()->get("user")["first_name"]) . " " . strtoupper(session()->get("user")["last_name"])) ?></b>
                </h2>
                <a href="<?= url_to("FRONTOFFICE-PROFILE") ?>" id="btn-more">En savoir plus</a>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
