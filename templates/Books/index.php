<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book[]|\Cake\Collection\CollectionInterface $books
 */
?>

<div class = "row">
    <?= $this->Html->link(__('New Book'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Books') ?></h3>
</div>


<div class="row">
    <?php foreach ($books as $book) : ?>
        <div class="col-12 col-md-4 col-lg-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://covers.openlibrary.org/b/isbn/<?= $book->isbn ?>-L.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $book->name ?></h5>
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