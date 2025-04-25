<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Place $place
 * @var \Cake\Collection\CollectionInterface|string[] $subcategories
 */
?>
<?= $this->Html->link('Back', '/new-menu', ['class' => 'px-1 pt-1', 'escape' => false]) ?>
<!-- Piplup Header -->
<div class="d-flex flex-wrap justify-content-start align-items-center">
    <?= $this->Html->image('piplup.png', [
        'class' => 'mb-3',
        'style' => 'width:113px; height:113px;',
        'alt' => 'Piplup'
    ]) ?>
    <h1 class="h3 mb-3 heading-title">New Place?</h1>
</div>
<div class="row">
    <div class="column column-80">
        <div class="places form content">
        <?= $this->Form->create($place) ?>
            <fieldset>
                <legend><?= __('Add Place') ?></legend>
                <?php
                    echo $this->Form->control('subcategory_id', ['options' => $subcategories]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('address');
                    echo $this->Form->control('description');
                ?>
            </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
        </div>
    </div>
</div>
