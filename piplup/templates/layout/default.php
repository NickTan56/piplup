<?php
/**
 * @var \App\View\AppView $this
 */
$cakeDescription = 'Piplup Places';
$apiKeys = include CONFIG . 'api_keys.php'; // Load API keys from the configuration file
$googleApiKey = $apiKeys['google_maps_api_key'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $cakeDescription ?>: <?= $this->fetch('title') ?></title>
    <?= $this->Html->css('https://unpkg.com/leaflet/dist/leaflet.css') ?>
    <?= $this->Html->meta('icon', 'webroot/favicon.ico') ?>
    <?= $this->Html->css('custom') ?>
    <?= $this->fetch('css') ?>
    <?= $this->Html->css('https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap', ['rel' => 'stylesheet']) ?>
    <?= $this->Html->meta(['rel' => 'preconnect', 'href' => 'https://fonts.googleapis.com']) ?>
    <?= $this->Html->meta(['rel' => 'preconnect', 'href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous']) ?>
    <?= $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css') ?>
    <?= $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css') ?>
</head>
<body class="pixelify-sans">
    <div class="map-container">
        <div id="map"></div>
        <div class="overlay-panel m-5">
            <?= $this->fetch('content') ?>
        </div>
    </div>

    <!-- Scripts -->
    <?= $this->Html->script('initMap') ?> 
    <?= $this->Html->script("https://maps.googleapis.com/maps/api/js?key={$googleApiKey}&libraries=places&callback=initMap", [
        'async' => true,
        'defer' => true
    ]) ?>
</body>
</html>
