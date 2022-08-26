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
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <?php }?>
    <div class="column-responsive column-80">
        <div class="users view content">
            <!--Check to see if name has been set up-->
            <?php if(empty($user->name)){?>
                <h3>Avid Reader extraordinaire</h3>
            <?php } else{ ?>
                <h3><?= h($user->name) ?></h3>
            <?php } ?>
            
            <?= $this->Html->link(__('Edit Profile'), ['action' => 'editProfile', $user->id], ['class' => 'button']) ?>
            <?= $this->Html->link(__('Account Settings'), ['action' => 'edit', $user->id], ['class' => 'button']) ?>
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
                    <th><?= __('About me') ?></th>
                    <!--Add check here if bio is not available-->
                    <?php if(empty($user->bio)){ ?>
                       <td><?= $this->Html->link(__('Fill out your bio'), ['action' => 'editProfile', $user->id], ['class' => 'side-nav-item']) ?></td>
                    <?php } else{ ?>
                        <td><?=h($user->bio) ?></td>
                    <?php } ?>
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
                            <th><?= __('Category') ?></th>
                            <th class="actions"><?= __('Status') ?></th>
                        </tr>
                        <?php foreach ($user->books as $key=>$books) : ?>
                        <tr>
                            <td><?= h($books->id) ?></td>
                            <td><?= h($books->name) ?></td>
                            <td><?= h($books->author) ?></td>
                            <td><?= h($books->description) ?></td>
                            <td><?= h($books->category->name) ?></td>
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
