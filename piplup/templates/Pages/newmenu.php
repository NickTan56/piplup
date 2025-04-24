<!-- Back Button -->
<?= $this->Html->link('Back', $this->request->referer(), ['class' => 'px-1 pt-1', 'escape' => false]) ?>
<!-- Piplup Header -->
<div class="d-flex flex-wrap justify-content-start align-items-center">
    <?= $this->Html->image('piplup.png', [
        'class' => 'mb-3',
        'style' => 'width:113px; height:113px;',
        'alt' => 'Piplup'
    ]) ?>
    <h1 class="h3 mb-3 heading-title">Piplup Places</h1>
</div>
<div class="row g-3 align-items-center">
    <!-- Left box -->
    <div class="col-auto">
        <div class="pixel-box">
            <strong>Select new option!</strong>
        </div>
    </div>

    <!-- Right buttons -->
    <div class="col-auto d-flex flex-column gap-2">
        <div class="d-flex gap-2">
            <?= $this->Html->link('Place', '/new-menu', ['class' => 'pixel-button orange']) ?>
            <button type="button" class="pixel-button green">Category</button>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="pixel-button blue">Subcat</button>
        </div>
    </div>
</div>
