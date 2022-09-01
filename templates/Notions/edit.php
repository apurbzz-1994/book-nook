<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notion $notion
 * @var string[]|\Cake\Collection\CollectionInterface $booksUsers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $notion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $notion->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Notions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="notions form content">
            <?= $this->Form->create($notion) ?>
            <fieldset>
                <legend><?= __('Edit Notion') ?></legend>
                <?php
                    echo $this->Form->control('description');
                    echo $this->Form->control('sale_price');
                    echo $this->Form->control('books_user_id', ['options' => $booksUsers]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
