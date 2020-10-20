<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VictimsRequest $victimsRequest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $victimsRequest->victim_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $victimsRequest->victim_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Victims Requests'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Victims'), ['controller' => 'Victims', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Victim'), ['controller' => 'Victims', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="victimsRequests form large-9 medium-8 columns content">
    <?= $this->Form->create($victimsRequest) ?>
    <fieldset>
        <legend><?= __('Edit Victims Request') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
