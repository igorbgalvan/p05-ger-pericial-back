<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VictimsRequest $victimsRequest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Victims Request'), ['action' => 'edit', $victimsRequest->victim_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Victims Request'), ['action' => 'delete', $victimsRequest->victim_id], ['confirm' => __('Are you sure you want to delete # {0}?', $victimsRequest->victim_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Victims Requests'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Victims Request'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Victims'), ['controller' => 'Victims', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Victim'), ['controller' => 'Victims', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="victimsRequests view large-9 medium-8 columns content">
    <h3><?= h($victimsRequest->victim_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Victim') ?></th>
            <td><?= $victimsRequest->has('victim') ? $this->Html->link($victimsRequest->victim->name, ['controller' => 'Victims', 'action' => 'view', $victimsRequest->victim->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Request') ?></th>
            <td><?= $victimsRequest->has('request') ? $this->Html->link($victimsRequest->request->id, ['controller' => 'Requests', 'action' => 'view', $victimsRequest->request->id]) : '' ?></td>
        </tr>
    </table>
</div>
