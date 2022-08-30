<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 */
?>
<div class="row">
    <!--Book image and CRUD functions-->
    <div class="col-12 col-md-4 col-lg-4">
        <img src="https://covers.openlibrary.org/b/isbn/<?= $book->isbn ?>-M.jpg" alt="<?= $book->name ?> book" class="img-thumbnail rounded mx-auto d-block">
        <!--actions-->
        <div style="text-align: center; margin-top: 2em;">
            <?= $this->Html->link(__('Edit Book'), ['action' => 'edit', $book->id], ['class' => 'btn btn-info btn-sm']) ?>
            <?= $this->Form->postLink(__('Delete Book'), ['action' => 'delete', $book->id], ['confirm' => __('Are you sure you want to delete # {0}?', $book->id), 'class' => 'btn btn-danger btn-sm']) ?>
        </div>
    </div>
    <!--book information-->
    <div class="col-12 col-md-8 col-lg-8">
        <h3><?= h($book->name) ?></h3>
        <table class="table">
            <tr>
                <th><?= __('Name') ?></th>
                <td><?= h($book->name) ?></td>
            </tr>
            <tr>
                <th><?= __('Author') ?></th>
                <td><?= h($book->author) ?></td>
            </tr>
            <tr>
                <th><?= __('Description') ?></th>
                <td><?= h($book->description) ?></td>
            </tr>
            <tr>
                <th><?= __('Category') ?></th>
                <td><span class="badge badge-dark"><?= h($book->category->name) ?></span></td>
            </tr>
        </table>
        <div style = "margin-top: 3em">
            <!--insights-->
            <h5>Did you know?</h5>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card" style="padding: 1em; text-align:center;">
                        <div class="card-body">
                            <p class="card-text">Number of readers added this book to their nook </p>
                            <hr>
                            <?php
                            $userCount = count($book->users);
                            ?>
                            <h3 class="card-title"><?= $userCount ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>