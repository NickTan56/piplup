<?php
/**
 * @var \App\View\AppView $this
 * @var string $message
 * @var string $url
 */
use Cake\Core\Configure;

$this->layout = 'default';

if (Configure::read('debug')) :
    $this->layout = 'dev_error';
    $this->assign('title', $message);
    $this->assign('templateName', 'error400.php');
    $this->start('file');
    echo $this->element('auto_table_warning');
    $this->end();
endif;
?>

<div class="text-center mt-5" style="font-family: 'Pixelify Sans', sans-serif;">
    <?= $this->Html->image('piplup.png', ['style' => 'width: 120px; height: auto;', 'alt' => 'Piplup']) ?>
    <h1 class="mt-4" style="font-size: 2.5rem;">Error 404</h1>
    <p class="mb-4" style="font-size: 1.25rem;">Piplup hasn't been here before!</p>
    <?= $this->Html->link('Back', '/', [
        'class' => 'pixel-button blue',
    ]) ?>
</div>
