<?= $this->extend("frontoffice/_pattern") ?>

<?= $this->section("assets") ?>
<link rel="stylesheet" href="<?= base_url("assets/css/frontoffice/techwatch.css") ?>">
<?= $this->endSection() ?>

<?= $this->section("main") ?>
<div id="container">
    <div id="headband">
        <div id="filter">
            <h1 style="text-transform: uppercase;">Veille technologique</h1>
            <svg id="headband-bottom" style="fill:#FFFFFF;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100"
                 preserveAspectRatio="none">
                <path class="svg-white-bg" d="M737.9,94.7L0,0v100h1000V0L737.9,94.7z"></path>
            </svg>
        </div>
    </div>
    <div id="article">
        <div id="article-header">
            <h1>Veille technologique</h1>
            <p>J'ai basé ma veille technologique sur l'<b>Intelligence Artificielle</b>.</p>
        </div>
        <div id="article-feeds">
            <?php foreach ($flux as $feed) { ?>
                <div class="article-items">
                    <h2><?= $feed["title"] ?></h2>
                    <?php foreach ($feed["items"] as $item) { ?>
                        <div class="article-items-content">
                            <h3><?= $item["title"] ?></h3>
                            <p><?= $item["description"] ?></p>
                            <a href="<?= $item["link"] ?>" target="_blank">Lire la suite</a>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
