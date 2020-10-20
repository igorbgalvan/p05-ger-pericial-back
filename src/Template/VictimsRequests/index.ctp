<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VictimsRequest[]|\Cake\Collection\CollectionInterface $victimsRequests
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Victims Request'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Victims'), ['controller' => 'Victims', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Victim'), ['controller' => 'Victims', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="victimsRequests index large-9 medium-8 columns content">
    <h3><?= __('Victims Requests') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('victim_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('request_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($victimsRequests as $victimsRequest): ?>
            <tr>
                <td><?= $victimsRequest->has('victim') ? $this->Html->link($victimsRequest->victim->name, ['controller' => 'Victims', 'action' => 'view', $victimsRequest->victim->id]) : '' ?></td>
                <td><?= $victimsRequest->has('request') ? $this->Html->link($victimsRequest->request->id, ['controller' => 'Requests', 'action' => 'view', $victimsRequest->request->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $victimsRequest->victim_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $victimsRequest->victim_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $victimsRequest->victim_id], ['confirm' => __('Are you sure you want to delete # {0}?', $victimsRequest->victim_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
