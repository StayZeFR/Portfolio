<?= $this->extend("frontoffice/_pattern") ?>

<?= $this->section("assets") ?>
<link rel="stylesheet" href="<?= base_url("assets/css/frontoffice/profile.css") ?>">
<?= $this->endSection() ?>

<?= $this->section("main") ?>
<div id="container">
    <div id="headband">
        <div id="filter">
            <h1 style="text-transform: uppercase;">Profil</h1>
            <svg id="headband-bottom" style="fill:#FFFFFF;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100"
                 preserveAspectRatio="none">
                <path class="svg-white-bg" d="M737.9,94.7L0,0v100h1000V0L737.9,94.7z"></path>
            </svg>
        </div>
    </div>
    <div id="article">
        <div id="profile">
            <div id="profile-picture" style="width: 200px; height: 200px; border-radius: 50%; background-image: url('<?= base_url(empty($profile["logo_path"]) ? "assets/resources/images/no-image.png" : $profile["logo_path"]) ?>'); background-repeat: no-repeat; background-size: cover;">
            </div>
            <div id="profile-info">
                <h2><?= $profile["first_name"] . " " . $profile["last_name"] ?></h2>
                <p><?= $profile["email"] ?></p>
            </div>
        </div>
        <div id="profile-actions">
        </div>
    </div>
</div>
<?= $this->endSection() ?>
