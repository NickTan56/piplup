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
            <strong>What will you do?</strong>
        </div>
    </div>

    <!-- Right buttons -->
    <div class="col-auto d-flex flex-column gap-2">
        <div class="d-flex gap-2">
            <?= $this->Html->link('Filter', '/newmenu', ['class' => 'pixel-button pink']) ?>
            <?= $this->Html->link('New', '/newmenu', ['class' => 'pixel-button orange']) ?>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="pixel-button green">Search</button>
            <button type="button" class="pixel-button blue">Direction</button>
        </div>
    </div>
</div>

<div class="info-panel bg-light border border-dark p-3 text-dark">
    <p><strong>Category:</strong> Sport</p>
    <p><strong>Sub Category:</strong> Pickleball</p>
    <p><strong>Name:</strong> Game4Padel</p>
    <p><strong>Address:</strong> 206 Lorimer St, Docklands VIC 3008</p>
    <p><strong>Description:</strong> Outdoor, pickleball with 4 courts</p>
</div>
