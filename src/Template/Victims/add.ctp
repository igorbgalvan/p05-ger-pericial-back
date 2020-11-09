<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Victim $victim
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Victims'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="victims form large-9 medium-8 columns content">
    <?= $this->Form->create($victim) ?>
    <fieldset>
        <legend><?= __('Add Victim') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('requests._ids', ['options' => $requests]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
