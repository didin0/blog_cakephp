<h1>Add Article</h1>

<?php 
    echo $this->form->create($article);
    echo $this->form->control('title');
    echo $this->form->control('body');
    echo $this->form->button('Save Article');
    echo $this->form->end();
?>