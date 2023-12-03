<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PORTFOLIO</title>
    <link rel="stylesheet" href="<?= base_url("assets/css/frontoffice/global.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/frontoffice/navigation.css") ?>">
    <script src="<?= base_url("assets/libs/jquery/jquery.js") ?>"></script>
    <?= $this->renderSection("assets") ?>
</head>
<body>
<?= $this->include("global/_navigation-frontoffice") ?>
<?= $this->renderSection("main") ?>
</body>
</html>