<?= $this->extend("global/_pattern-frontoffice") ?>

<?= $this->section("assets") ?>
<link rel="stylesheet" href="<?= base_url("assets/css/frontoffice/projects.css") ?>">
<?= $this->endSection() ?>

<?= $this->section("main") ?>
<div id="container">
    <div id="headband">
        <div id="filter">
            <h1 style="text-transform: uppercase;">Projets</h1>
            <svg id="headband-bottom" style="fill:#FFFFFF;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100"
                 preserveAspectRatio="none">
                <path class="svg-white-bg" d="M737.9,94.7L0,0v100h1000V0L737.9,94.7z"></path>
            </svg>
        </div>
    </div>
    <div id="article">

    </div>
</div>
<?= $this->endSection() ?>
