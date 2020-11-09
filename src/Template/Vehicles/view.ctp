<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vehicle $vehicle
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vehicle'), ['action' => 'edit', $vehicle->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vehicle'), ['action' => 'delete', $vehicle->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicle->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vehicles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vehicles view large-9 medium-8 columns content">
    <h3><?= h($vehicle->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Marca') ?></th>
            <td><?= h($vehicle->marca) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Placa') ?></th>
            <td><?= h($vehicle->placa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cor') ?></th>
            <td><?= h($vehicle->cor) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($vehicle->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Requests') ?></h4>
        <?php if (!empty($vehicle->requests)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Data Documento') ?></th>
                <th scope="col"><?= __('Data Realizacao Pericia') ?></th>
                <th scope="col"><?= __('Data Recebimento') ?></th>
                <th scope="col"><?= __('Tipo Pericia') ?></th>
                <th scope="col"><?= __('Tipo Requisicao') ?></th>
                <th scope="col"><?= __('Exame Pericia') ?></th>
                <th scope="col"><?= __('Descricao') ?></th>
                <th scope="col"><?= __('Nome Vitima') ?></th>
                <th scope="col"><?= __('N Documento') ?></th>
                <th scope="col"><?= __('N Bo') ?></th>
                <th scope="col"><?= __('N Ip') ?></th>
                <th scope="col"><?= __('Outros Proc') ?></th>
                <th scope="col"><?= __('Escrivao') ?></th>
                <th scope="col"><?= __('Delegacia') ?></th>
                <th scope="col"><?= __('Autoridade Requisitante') ?></th>
                <th scope="col"><?= __('Tipo Logradouro') ?></th>
                <th scope="col"><?= __('Logradouro') ?></th>
                <th scope="col"><?= __('Nmr Logradouro') ?></th>
                <th scope="col"><?= __('Bairro') ?></th>
                <th scope="col"><?= __('Cidade') ?></th>
                <th scope="col"><?= __('N Laudos Expedidos') ?></th>
                <th scope="col"><?= __('N Oficio') ?></th>
                <th scope="col"><?= __('Cargo') ?></th>
                <th scope="col"><?= __('Observacoes') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vehicle->requests as $requests): ?>
            <tr>
                <td><?= h($requests->id) ?></td>
                <td><?= h($requests->data_documento) ?></td>
                <td><?= h($requests->data_realizacao_pericia) ?></td>
                <td><?= h($requests->data_recebimento) ?></td>
                <td><?= h($requests->tipo_pericia) ?></td>
                <td><?= h($requests->tipo_requisicao) ?></td>
                <td><?= h($requests->exame_pericia) ?></td>
                <td><?= h($requests->descricao) ?></td>
                <td><?= h($requests->nome_vitima) ?></td>
                <td><?= h($requests->n_documento) ?></td>
                <td><?= h($requests->n_bo) ?></td>
                <td><?= h($requests->n_ip) ?></td>
                <td><?= h($requests->outros_proc) ?></td>
                <td><?= h($requests->escrivao) ?></td>
                <td><?= h($requests->delegacia) ?></td>
                <td><?= h($requests->autoridade_requisitante) ?></td>
                <td><?= h($requests->tipo_logradouro) ?></td>
                <td><?= h($requests->logradouro) ?></td>
                <td><?= h($requests->nmr_logradouro) ?></td>
                <td><?= h($requests->bairro) ?></td>
                <td><?= h($requests->cidade) ?></td>
                <td><?= h($requests->n_laudos_expedidos) ?></td>
                <td><?= h($requests->n_oficio) ?></td>
                <td><?= h($requests->cargo) ?></td>
                <td><?= h($requests->observacoes) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Requests', 'action' => 'view', $requests->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Requests', 'action' => 'edit', $requests->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Requests', 'action' => 'delete', $requests->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requests->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
