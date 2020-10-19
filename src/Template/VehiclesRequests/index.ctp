<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VehiclesRequest[]|\Cake\Collection\CollectionInterface $vehiclesRequests
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Vehicles Request'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vehiclesRequests index large-9 medium-8 columns content">
    <h3><?= __('Vehicles Requests') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('vehicle_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('request_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vehiclesRequests as $vehiclesRequest): ?>
            <tr>
                <td><?= $vehiclesRequest->has('vehicle') ? $this->Html->link($vehiclesRequest->vehicle->id, ['controller' => 'Vehicles', 'action' => 'view', $vehiclesRequest->vehicle->id]) : '' ?></td>
                <td><?= $vehiclesRequest->has('request') ? $this->Html->link($vehiclesRequest->request->id, ['controller' => 'Requests', 'action' => 'view', $vehiclesRequest->request->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $vehiclesRequest->vehicle_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $vehiclesRequest->vehicle_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $vehiclesRequest->vehicle_id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehiclesRequest->vehicle_id)]) ?>
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
