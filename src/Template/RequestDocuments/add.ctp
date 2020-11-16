<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RequestDocument $requestDocument
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Request Documents'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="requestDocuments form large-9 medium-8 columns content">
    <?= $this->Form->create($requestDocument) ?>
    <fieldset>
        <legend><?= __('Add Request Document') ?></legend>
        <?php
            echo $this->Form->control('request_id', ['options' => $requests]);
            echo $this->Form->control('doc_name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
