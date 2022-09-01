<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notion $notion
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Notion'), ['action' => 'edit', $notion->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Notion'), ['action' => 'delete', $notion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notion->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Notions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Notion'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="notions view content">
            <h3><?= h($notion->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($notion->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sale Price') ?></th>
                    <td><?= h($notion->sale_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Books User') ?></th>
                    <td><?= $notion->has('books_user') ? $this->Html->link($notion->books_user->id, ['controller' => 'BooksUsers', 'action' => 'view', $notion->books_user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($notion->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
