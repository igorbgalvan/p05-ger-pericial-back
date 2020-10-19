<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Request $request
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Request'), ['action' => 'edit', $request->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Request'), ['action' => 'delete', $request->id], ['confirm' => __('Are you sure you want to delete # {0}?', $request->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Requests'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="requests view large-9 medium-8 columns content">
    <h3><?= h($request->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Tipo Pericia') ?></th>
            <td><?= h($request->tipo_pericia) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Exame Pericia') ?></th>
            <td><?= h($request->exame_pericia) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descrição') ?></th>
            <td><?= h($request->descrição) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome Vitima') ?></th>
            <td><?= h($request->nome_vitima) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('N Documento') ?></th>
            <td><?= h($request->n_documento) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('N Bo') ?></th>
            <td><?= h($request->n_bo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('N Ip') ?></th>
            <td><?= h($request->n_ip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Outros Proc') ?></th>
            <td><?= h($request->outros_proc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Escrivao') ?></th>
            <td><?= h($request->escrivao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delegacia') ?></th>
            <td><?= h($request->delegacia) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Autoridade Requisitante') ?></th>
            <td><?= h($request->autoridade_requisitante) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo Logradouro') ?></th>
            <td><?= h($request->tipo_logradouro) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Logradouro') ?></th>
            <td><?= h($request->logradouro) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nmr Logradouro') ?></th>
            <td><?= h($request->nmr_logradouro) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bairro') ?></th>
            <td><?= h($request->bairro) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cidade') ?></th>
            <td><?= h($request->cidade) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('N Laudos Expedidos') ?></th>
            <td><?= h($request->n_laudos_expedidos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('N Oficio') ?></th>
            <td><?= h($request->n_oficio) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cargo') ?></th>
            <td><?= h($request->cargo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Observações') ?></th>
            <td><?= h($request->observações) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($request->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data Documento') ?></th>
            <td><?= h($request->data_documento) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data Realização Perícia') ?></th>
            <td><?= h($request->data_realização_perícia) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data Recebimento') ?></th>
            <td><?= h($request->data_recebimento) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Vehicles') ?></h4>
        <?php if (!empty($request->vehicles)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Marca') ?></th>
                <th scope="col"><?= __('Placa') ?></th>
                <th scope="col"><?= __('Cor') ?></th>
                <th scope="col"><?= __('Tipo') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($request->vehicles as $vehicles): ?>
            <tr>
                <td><?= h($vehicles->id) ?></td>
                <td><?= h($vehicles->marca) ?></td>
                <td><?= h($vehicles->placa) ?></td>
                <td><?= h($vehicles->cor) ?></td>
                <td><?= h($vehicles->tipo) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Vehicles', 'action' => 'view', $vehicles->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Vehicles', 'action' => 'edit', $vehicles->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Vehicles', 'action' => 'delete', $vehicles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicles->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
