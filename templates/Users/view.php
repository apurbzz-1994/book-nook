<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">

    <!--Personal information-->
    <div class="col-12 col-md-4 col-lg-4">
        <!--Check to see if name has been set up-->
        <?php if (empty($user->name)) { ?>
            <h3>Avid Reader extraordinaire</h3>
        <?php } else { ?>
            <h3><?= h($user->name) ?></h3>
        <?php } ?>

        <!--Adding logic so that the actions column appears only when user visits their own profile-->
        <?php
        $loggedInUserId = $this->Identity->get('id');
        if ($loggedInUserId == $user->id) {
        ?>
            <!--edit links-->
            <?= $this->Html->link(__('Edit Profile'), ['action' => 'editProfile', $user->id], ['class' => 'btn btn-info btn-sm']) ?>
            <?= $this->Html->link(__('Account Settings'), ['action' => 'edit', $user->id], ['class' => 'btn btn-info btn-sm']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-danger btn-sm']) ?>
        <?php } ?>


        <table class="table">
            <tr>
                <th><?= __('Email') ?></th>
                <td><?= h($user->email) ?></td>
            </tr>
            <tr>
                <th><?= __('Role') ?></th>
                <td><?= h($user->role) ?></td>
            </tr>
            <tr>
                <th><?= __('About me') ?></th>
                <!--Add check here if bio is not available-->
                <?php if (empty($user->bio)) { ?>
                    <td><?= $this->Html->link(__('Fill out your bio'), ['action' => 'editProfile', $user->id], ['class' => 'side-nav-item']) ?></td>
                <?php } else { ?>
                    <td><?= h($user->bio) ?></td>
                <?php } ?>
            </tr>
        </table>
    </div>
    <!--book display-->
    <div class="col-12 col-md-8 col-lg-8">
        <h3><?= __('My Books') ?></h3>
        <?= $this->Html->link(__('Add a book'), ['action' => 'addBookByUser', $user->id], ['class' => 'btn btn-info btn-sm']) ?>
        <?php if (!empty($user->books)) : ?>
                <!--creating a form here to select book status-->
                <?= $this->Form->create($user); ?>
                <div class = "row" style="margin:1em;">
                <?php foreach ($user->books as $key => $books) : ?>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card" style="padding-bottom:2em;">
                            <div class="card-header">
                                <?= h($books->name) ?>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><span class="badge badge-dark"><?= h($books->category->name) ?></span></li>
                                <li class="list-group-item"><b>Author:</b> <?= h($books->author) ?></li>
                                <li class="list-group-item"><b>Description: </b><?= h($books->description) ?></li>
                            </ul>
                            <!--book status-->
                            <!--
                                   Please note that this is not correct:
                                   echo $this->Form->control('user.books.'.$key.'._joinData.status');
                                   The user here is not required. You can create a form field for 
                                   any of the
                               -->
                            <?php
                            $optionsArray = ['Want to Read' => 'Want to Read', 'Reading' => 'Reading', 'Finished' => 'Finished'];
                            echo $this->Form->control('books.' . $key . '.hiddenid', ['value' => $books->id, 'type' => 'hidden']);
                            echo $this->Form->control('books.' . $key . '._joinData.status', ['options' => $optionsArray, 'label' => false]);
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>

                <?= $this->Form->button(__('Change Reading Status'), ['class' => 'btn btn-primary btn-sm btn-block']) ?>
                <?= $this->Form->end() ?>
        <?php endif; ?>
    </div>

</div>
<!--End row div here-->