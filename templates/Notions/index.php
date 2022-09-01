<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notion[]|\Cake\Collection\CollectionInterface $notions
 */
?>

<!--header stuff-->
<div class="row">
    <div class="col-12 col-md-12 col-lg-12 text-center">
        <blockquote class="blockquote mb-2">
            <h1>"Notions"</h1>
            <footer class="blockquote-footer">By <cite title="Source Title">Some book</cite></footer>
        </blockquote>
    </div>
</div>

<!--add notions here-->
<div class="row">
    <div class="col-12 col-md-12 col-lg-12 text-center">
        
    </div>
</div>

<!--load notions here-->
<div class="row">
    <?php foreach ($notions as $notion) : ?>
        <div class="col-12 col-md-12 col-lg-12 mb-2 mt-2">
            <div class="card">
                <div class="card-body">
                    <p class="card-text"><?= h($notion->description) ?></p>
                    <p class="card-text">Useful for:
                    <h6><span class="badge badge-primary"><?= h($notion->sale_price) ?></span></h6>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>




<div class="notions index content">
    <?= $this->Html->link(__('New Notion'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Notions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('sale_price') ?></th>
                    <th><?= $this->Paginator->sort('books_user_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notions as $notion) : ?>
                    <tr>
                        <td><?= $this->Number->format($notion->id) ?></td>
                        <td><?= h($notion->description) ?></td>
                        <td><?= h($notion->sale_price) ?></td>
                        <td><?= $notion->has('books_user') ? $this->Html->link($notion->books_user->id, ['controller' => 'BooksUsers', 'action' => 'view', $notion->books_user->id]) : '' ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $notion->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $notion->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notion->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
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