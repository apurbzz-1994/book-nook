<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
     <!--Adding logic so that the actions column appears only when user visits their own profile-->
    <?php 
        $loggedInUserId = $this->Identity->get('id');
        if($loggedInUserId == $user->id){
    ?> 
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <?php }?>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->id) ?></h3>
            <?= $this->Html->link(__('Edit Profile'), ['action' => 'editProfile', $user->id], ['class' => 'button']) ?>
            <table>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= h($user->role) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('My Books') ?></h4>
                <?= $this->Html->link(__('Add a book'), ['action' => 'addBookByUser', $user->id], ['class' => 'button']) ?>
                <?php if (!empty($user->books)) : ?>
                <div class="table-responsive">
                     <!--creating a form here to select book status-->
                     <?= $this->Form->create($user); ?>
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Author') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Category Id') ?></th>
                            <th class="actions"><?= __('Status') ?></th>
                        </tr>
                        <?php foreach ($user->books as $key=>$books) : ?>
                        <tr>
                            <td><?= h($books->id) ?></td>
                            <td><?= h($books->name) ?></td>
                            <td><?= h($books->author) ?></td>
                            <td><?= h($books->description) ?></td>
                            <td><?= h($books->category_id) ?></td>
                            <td class="actions">

                               <!--
                                   Please note that this is not correct:
                                   echo $this->Form->control('user.books.'.$key.'._joinData.status');
                                   The user here is not required. You can create a form field for 
                                   any of the
                               -->
                               <?php
                                    $optionsArray = ['Want to Read' => 'Want to Read', 'Reading' => 'Reading', 'Finished'=>'Finished'];
                                    echo $this->Form->control('books.'.$key.'.hiddenid', ['value'=> $books->id, 'type'=>'hidden']);
                                    echo $this->Form->control('books.'.$key.'._joinData.status', ['options'=>$optionsArray]);
                               ?>
                               
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <?= $this->Form->button(__('Change Reading Status')) ?>
                    <?= $this->Form->end() ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
