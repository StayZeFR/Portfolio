<?= $this->extend("frontoffice/_pattern") ?>

<?= $this->section("assets") ?>
    <link rel="stylesheet" href="<?= base_url("assets/css/frontoffice/home.css") ?>">
    <script src="<?= base_url("assets/libs/tsparticles/tsparticles.js") ?>"></script>
    <script src="<?= base_url("assets/js/frontoffice/home.js") ?>"></script>
<?= $this->endSection() ?>

<?= $this->section("main") ?>
    <div id="container">
        <div id="filter">
            <div id="filter-content">
                <h1>BIENVENUE</h1>
                <h2>Je m'appelle <b><span>Blandin Ilann</span></b>
                </h2>
                <a href="<?= url_to("FRONTOFFICE-PROFILE") ?>" id="btn-more">En savoir plus</a>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
