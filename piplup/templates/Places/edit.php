<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Place $place
 * @var string[]|\Cake\Collection\CollectionInterface $subcategories
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $place->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $place->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Places'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="places form content">
            <?= $this->Form->create($place) ?>
            <fieldset>
                <legend><?= __('Edit Place') ?></legend>
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
