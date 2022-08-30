<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var string[]|\Cake\Collection\CollectionInterface $books
 */
?>

<h3>Customise my collection</h3>

<div class="row justify-content-md-center py-5">
    <div class="col-12 col-md-12 col-lg-12">
        <?= $this->Form->create($user) ?>
        <?php

        // preparing images for checkboxes:
        $dataArray = array();


        foreach ($allBooks as $book) {
            $dataArray[$book->id] = "<img src='https://covers.openlibrary.org/b/isbn/" . $book->isbn . "-S.jpg' style='margin:1em'>" . "  " . $book->name;
        }


        echo $this->Form->control('books._ids', ['options' => $dataArray, 'type' => 'select', 'multiple' => 'checkbox', 'escape' => false, 'label' => false]);
        //books.0._joinData.status, ["value" => ""]
        ?>
        <?= $this->Form->button(__('Save changes'),['class'=>'btn btn-info btn-md']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>