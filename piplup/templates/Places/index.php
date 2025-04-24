<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Place> $places
 */
?>
<!-- Piplup Header -->
<div class="d-flex flex-wrap justify-content-start align-items-center">
    <?= $this->Html->image('piplup.png', [
        'class' => 'mb-3',
        'style' => 'width:113px; height:113px;',
        'alt' => 'Piplup'
    ]) ?>
    <h1 class="h3 mb-3 heading-title">Piplup Places</h1>
</div>

<!-- Top Action Panel -->
<div class="row g-3 align-items-center">
    <!-- Left box -->
    <div class="col-auto">
        <div class="pixel-box">
            <strong>What will you do?</strong>
        </div>
    </div>

    <!-- Right buttons -->
    <div class="col-auto d-flex flex-column gap-2">
        <div class="d-flex gap-2">
            <button type="button" class="pixel-button pink">Filter</button>
            <?= $this->Html->link('New', '/new-menu', ['class' => 'pixel-button orange']) ?>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="pixel-button green">Search</button>
            <button type="button" class="pixel-button blue">List</button>
        </div>
    </div>
</div>

<!-- Place List Section -->
<div class="info-panel bg-light border border-dark p-3 text-dark mt-4">
    <div class="place-list">
        <div class="d-flex fw-bold border-bottom pb-2 mb-2" style="font-family: 'Pixelify Sans';">
            <div class="flex-fill">Category</div>
            <div class="flex-fill">Subcategory</div>
            <div class="flex-fill">Name</div>
            <div class="flex-fill">Address</div>
        </div>

        <?php foreach ($places as $place): ?>
            <div class="d-flex border-bottom py-2" style="font-family: 'Pixelify Sans';">
                <div class="flex-fill"><?= h($place->subcategory->category->name ?? '') ?></div>
                <div class="flex-fill"><?= h($place->subcategory->name ?? '') ?></div>
                <div class="flex-fill"><?= h($place->name) ?></div>
                <div class="flex-fill">
                    <a href="https://www.google.com/maps/dir/?api=1&destination=<?= urlencode($place->address) ?>" target="_blank" rel="noopener">
                        <?= $this->Html->link('<i class="bi bi-sign-turn-right-fill"></i>', 
                            "https://www.google.com/maps/dir/?api=1&destination=" . urlencode($place->address), [
                            'escape' => false,
                            'target' => '_blank',
                            'rel' => 'noopener',
                            'title' => 'Open in Google Maps'
                        ]) ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <!-- Paginator -->
    <div class="paginator mt-4">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
