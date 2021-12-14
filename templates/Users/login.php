<h1>Login</h1>
<div class="users form">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend>Please enter username and password</legend>
        <?= $this->form->control('email', ['required' => true]) ?>
        <?= $this->form->control('password', ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Login')) ?>
    <?= $this->Form->end() ?>

    <?= $this->Html->link("S'inscrire", ['action' => 'add']) ?>
</div>