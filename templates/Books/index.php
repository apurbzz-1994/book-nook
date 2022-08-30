<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book[]|\Cake\Collection\CollectionInterface $books
 */
?>

<div class = "row">
    <div class = "col-12 col-md-12 col-lg-12">
        <h3><?= __('Books') ?></h3>
        <?= $this->Html->link(__('New Book'), ['action' => 'add'], ['class' => 'btn btn-info btn-md', 'style'=>'margin-bottom: 1em;']) ?>
    </div>
</div>


<div class="row">
    <?php foreach ($books as $book) : ?>
        <div class="col-12 col-md-4 col-lg-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <img src="https://covers.openlibrary.org/b/isbn/<?= $book->isbn ?>-M.jpg" alt="<?= $book->name ?> book" class="img-thumbnail rounded mx-auto d-block">
                    <h5 class="card-title" style="margin-top: 1em;"><?= $book->name ?></h5>
                    <p class="card-text"><?= $book->description ?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Author: </b><?= $book->author ?></li>
                    <li class="list-group-item"><span class="badge badge-dark"><?= h($book->category->name) ?></span></li>
                </ul>
                <div class="card-body">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $book->id], ['class' => 'btn btn-info btn-sm']) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="row">
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