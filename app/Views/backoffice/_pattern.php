<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PORTFOLIO</title>

    <link rel="stylesheet" href="<?= base_url("assets/css/backoffice/global.css") ?>">
    <!--<link rel="stylesheet" href="<?= base_url("assets/css/backoffice/navigation.css") ?>">-->
    <link rel="stylesheet" href="<?= base_url("assets/libs/salesforce/salesforce-lightning-design-system.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/libs/datatables/datatables.min.css") ?>">

    <script>
        const BASE_URL = "<?= base_url() ?>";
        const BASE_URL_API = "<?= base_url("api") ?>";
        const USER = <?= json_encode(session()->get("user")) ?>;
    </script>
    <script src="<?= base_url("assets/libs/jquery/jquery.js") ?>"></script>
    <script src="<?= base_url("assets/libs/datatables/datatables.min.js") ?>"></script>
    <script src="<?= base_url("assets/libs/sweetalert/sweetalert.js") ?>"></script>
    <script src="<?= base_url("assets/js/backoffice/global.js") ?>"></script>

    <?= $this->renderSection("assets") ?>
</head>
<body>
<?php
    if ($page !== "BACKOFFICE-LOGIN") {
        echo $this->include("backoffice/_navigation");
    }
?>
<?= $this->renderSection("main") ?>
</body>
</html>