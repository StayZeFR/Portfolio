<?= $this->extend("frontoffice/_pattern") ?>

<?= $this->section("assets") ?>
<link rel="stylesheet" href="<?= base_url("assets/css/frontoffice/projects.css") ?>">
<script src="<?= base_url("assets/js/frontoffice/projects.js") ?>"></script>
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
        <div id="filter-projects">
            <input type="text" id="filter-search" class="filter-input" placeholder="Votre recherche...">
            <select id="filter-category" class="filter-input">
            </select>
            <input type="button" id="filter-button" class="filter-input" value="Filtrer" onclick="filter()">
        </div>
        <div id="projects-list"></div>
    </div>
</div>
<?= $this->endSection() ?>
