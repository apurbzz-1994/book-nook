<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 * @var \Cake\Collection\CollectionInterface|string[] $categories
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<h3>Add a new book</h3>

<div class="row justify-content-md-center py-5">
    <div class="col-12 col-md-12 col-lg-12">
        <?= $this->Form->create($book) ?>
        <!--Book Title-->
        <div class="form-group row">
            <label for="bookname" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <?= $this->Form->control('name', ['label' => false, 'class' => 'form-control']) ?>
            </div>
        </div>
        <!--Book Author-->
        <div class="form-group row">
            <label for="bookauthor" class="col-sm-2 col-form-label">Author</label>
            <div class="col-sm-10">
                <?= $this->Form->control('author', ['label' => false, 'class' => 'form-control']) ?>
            </div>
        </div>
        <!--Book ISBN-->
        <div class="form-group row">
            <label for="bookisbn" class="col-sm-2 col-form-label">ISBN</label>
            <div class="col-sm-10">
                <?= $this->Form->control('isbn', ['label' => false, 'class' => 'form-control', 'id'=>'isbnfield']) ?>
            </div>
        </div>
        <!--Book category-->
        <div class="form-group row">
            <label for="bookisbn" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
                <?= $this->Form->control('category_id', ['options' => $categories, 'label' => false, 'class' => 'form-control']) ?>
            </div>
        </div>
        <!--Book description-->
        <div class="form-group row">
            <label for="bookisbn" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <?= $this->Form->control('description', ['label' => false, 'class' => 'form-control', 'type' => 'textarea', 'rows' => 4]) ?>
            </div>
        </div>
        <div class = "pt-3">
            <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-info btn-md']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
    <div id = "book-display">
        No book available
    </div>
    
</div>

<script>
    const isbnField = document.getElementById('isbnfield');
    const imgDisplayDiv = document.getElementById('book-display');
    isbnField.addEventListener('change', (e) => {
        imgDisplayDiv.innerHTML = '';
        let imageTag = document.createElement('img');
        let url = `https://covers.openlibrary.org/b/isbn/${e.target.value}-M.jpg`;
        imageTag.setAttribute("src", url);
        imgDisplayDiv.appendChild(imageTag);
    });
</script>