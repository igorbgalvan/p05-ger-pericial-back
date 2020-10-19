<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Request[]|\Cake\Collection\CollectionInterface $requests
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Request'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="requests index large-9 medium-8 columns content">
    <h3><?= __('Requests') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('data_documento') ?></th>
                <th scope="col"><?= $this->Paginator->sort('data_realização_perícia') ?></th>
                <th scope="col"><?= $this->Paginator->sort('data_recebimento') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tipo_pericia') ?></th>
                <th scope="col"><?= $this->Paginator->sort('exame_pericia') ?></th>
                <th scope="col"><?= $this->Paginator->sort('descrição') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nome_vitima') ?></th>
                <th scope="col"><?= $this->Paginator->sort('n_documento') ?></th>
                <th scope="col"><?= $this->Paginator->sort('n_bo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('n_ip') ?></th>
                <th scope="col"><?= $this->Paginator->sort('outros_proc') ?></th>
                <th scope="col"><?= $this->Paginator->sort('escrivao') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delegacia') ?></th>
                <th scope="col"><?= $this->Paginator->sort('autoridade_requisitante') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tipo_logradouro') ?></th>
                <th scope="col"><?= $this->Paginator->sort('logradouro') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nmr_logradouro') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bairro') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cidade') ?></th>
                <th scope="col"><?= $this->Paginator->sort('n_laudos_expedidos') ?></th>
                <th scope="col"><?= $this->Paginator->sort('n_oficio') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cargo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('observações') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $request): ?>
            <tr>
                <td><?= $this->Number->format($request->id) ?></td>
                <td><?= h($request->data_documento) ?></td>
                <td><?= h($request->data_realização_perícia) ?></td>
                <td><?= h($request->data_recebimento) ?></td>
                <td><?= h($request->tipo_pericia) ?></td>
                <td><?= h($request->exame_pericia) ?></td>
                <td><?= h($request->descrição) ?></td>
                <td><?= h($request->nome_vitima) ?></td>
                <td><?= h($request->n_documento) ?></td>
                <td><?= h($request->n_bo) ?></td>
                <td><?= h($request->n_ip) ?></td>
                <td><?= h($request->outros_proc) ?></td>
                <td><?= h($request->escrivao) ?></td>
                <td><?= h($request->delegacia) ?></td>
                <td><?= h($request->autoridade_requisitante) ?></td>
                <td><?= h($request->tipo_logradouro) ?></td>
                <td><?= h($request->logradouro) ?></td>
                <td><?= h($request->nmr_logradouro) ?></td>
                <td><?= h($request->bairro) ?></td>
                <td><?= h($request->cidade) ?></td>
                <td><?= h($request->n_laudos_expedidos) ?></td>
                <td><?= h($request->n_oficio) ?></td>
                <td><?= h($request->cargo) ?></td>
                <td><?= h($request->observações) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $request->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $request->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $request->id], ['confirm' => __('Are you sure you want to delete # {0}?', $request->id)]) ?>
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
