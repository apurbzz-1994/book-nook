<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notion[]|\Cake\Collection\CollectionInterface $notions
 */
?>

<!--header stuff-->
<div class="row">
    <!--add notions form here-->
    <div class="col-12 col-md-8 col-lg-8 mb-4">
        <blockquote class="blockquote">
            <h3>"Notions"</h3>
            <footer class="blockquote-footer">From <cite title="Source Title"><?= $bookObject->name ?></cite></footer>
        </blockquote>
        <?= $this->Form->create($notion) ?>
        <!--Details-->
        <div class="form-group row">
            <label for="details" class="col-sm-2 col-form-label">Details</label>
            <div class="col-sm-10">
                <?= $this->Form->control('description', ['label' => false, 'class' => 'form-control']) ?>
            </div>
        </div>
        <!--Useful for-->
        <div class="form-group row">
            <label for="usefulfor" class="col-sm-2 col-form-label">Useful For</label>
            <div class="col-sm-10">
                <?= $this->Form->control('sale_price', ['label' => false, 'class' => 'form-control']) ?>
            </div>
        </div>
        <?= $this->Form->button(__('Add Notion'), ['class' => 'btn btn-info btn-md']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>


<!--load notions here-->
<div class="row">
    <?php if (count($notions) == 0) { ?>
        <div class="col-12 col-md-12 col-lg-12 mb-2 mt-2">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">You have no notions related to this book yet. Try to
                        ponder about the concepts the book covers after you've read a chapter or two
                        and then add your ideas/reflections as notions. 
                    </p>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php foreach ($notions as $notion) : ?>
        <div class="col-12 col-md-12 col-lg-12 mb-2 mt-2">
            <div class="card">
                <div class="card-body">
                    <p class="card-text"><?= h($notion->description) ?></p>
                    <p class="card-text"><b>Useful for:</b>
                    <h6><span class="badge badge-primary"><?= h($notion->sale_price) ?></span></h6>
                    </p>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $notion->id], ['class' => 'fas fa-edit']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notion->id), 'class' => 'fas fa-trash']) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
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