<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Category> $categories
 */
?>
<?= $this->Html->link('Back', '/list-menu', ['class' => 'px-1 pt-1', 'escape' => false]) ?>
<!-- Piplup Header -->
<div class="d-flex flex-wrap justify-content-start align-items-center">
    <?= $this->Html->image('piplup.png', [
        'class' => 'mb-3',
        'style' => 'width:113px; height:113px;',
        'alt' => 'Piplup'
    ]) ?>
    <h1 class="h3 mb-3 heading-title">Subcategories</h1>
</div>
<div class="d-flex flex-column align-items-center">
    <!-- Place List Section -->
    <div class="info-panel border border-dark p-3 text-dark table-wrapper" style="max-height: 400px; overflow-y: auto;">
        <table class="place-list table table-borderless">
            <thead class="fw-bold border-bottom pb-2 mb-2">
                <tr>
                    <th>Name</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $index => $category): ?>
                <tr class="border-bottom py-2 clickable-row" data-index="<?= $index ?>">
                    <td><?= h($category->name) ?></td>
                    <td><?= h($category->created) ?></td>
                    <td><?= h($category->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $category->id], ['class' => 'link-dark']) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $category->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $category->id),
                                'class' => 'link-dark',
                            ],
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>