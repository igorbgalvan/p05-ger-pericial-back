<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VehiclesRequest $vehiclesRequest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vehicles Request'), ['action' => 'edit', $vehiclesRequest->vehicle_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vehicles Request'), ['action' => 'delete', $vehiclesRequest->vehicle_id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehiclesRequest->vehicle_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vehicles Requests'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicles Request'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vehiclesRequests view large-9 medium-8 columns content">
    <h3><?= h($vehiclesRequest->vehicle_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Vehicle') ?></th>
            <td><?= $vehiclesRequest->has('vehicle') ? $this->Html->link($vehiclesRequest->vehicle->id, ['controller' => 'Vehicles', 'action' => 'view', $vehiclesRequest->vehicle->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Request') ?></th>
            <td><?= $vehiclesRequest->has('request') ? $this->Html->link($vehiclesRequest->request->id, ['controller' => 'Requests', 'action' => 'view', $vehiclesRequest->request->id]) : '' ?></td>
        </tr>
    </table>
</div>
