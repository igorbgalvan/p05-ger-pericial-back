<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RequestDocument $requestDocument
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Request Document'), ['action' => 'edit', $requestDocument->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Request Document'), ['action' => 'delete', $requestDocument->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requestDocument->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Request Documents'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request Document'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="requestDocuments view large-9 medium-8 columns content">
    <h3><?= h($requestDocument->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Request') ?></th>
            <td><?= $requestDocument->has('request') ? $this->Html->link($requestDocument->request->id, ['controller' => 'Requests', 'action' => 'view', $requestDocument->request->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Doc Name') ?></th>
            <td><?= h($requestDocument->doc_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($requestDocument->id) ?></td>
        </tr>
    </table>
</div>
