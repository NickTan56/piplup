<?php
/**
 * @var \App\View\AppView $this
 */
$cakeDescription = 'GIS Map Project';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $cakeDescription ?>: <?= $this->fetch('title') ?></title>
    <?= $this->Html->css('https://unpkg.com/leaflet/dist/leaflet.css') ?>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('custom') ?>
    <?= $this->fetch('css') ?>
    <?= $this->Html->css('https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap', ['rel' => 'stylesheet']) ?>
    <?= $this->Html->meta(['rel' => 'preconnect', 'href' => 'https://fonts.googleapis.com']) ?>
    <?= $this->Html->meta(['rel' => 'preconnect', 'href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous']) ?>
    <?= $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css') ?>
</head>
<body class="pixelify-sans">

    <div id="map"></div>
    <div class="overlay-panel m-5">
        <?= $this->fetch('content') ?>
    </div>

    <?= $this->Html->script('https://unpkg.com/leaflet/dist/leaflet.js') ?>
    <?= $this->Html->script('map') ?>
</body>
</html>
