<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Request $request
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $request->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $request->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Requests'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="requests form large-9 medium-8 columns content">
    <?= $this->Form->create($request) ?>
    <fieldset>
        <legend><?= __('Edit Request') ?></legend>
        <?php
            echo $this->Form->control('data_documento', ['empty' => true]);
            echo $this->Form->control('data_realização_perícia', ['empty' => true]);
            echo $this->Form->control('data_recebimento', ['empty' => true]);
            echo $this->Form->control('tipo_pericia');
            echo $this->Form->control('exame_pericia');
            echo $this->Form->control('descrição');
            echo $this->Form->control('nome_vitima');
            echo $this->Form->control('n_documento');
            echo $this->Form->control('n_bo');
            echo $this->Form->control('n_ip');
            echo $this->Form->control('outros_proc');
            echo $this->Form->control('escrivao');
            echo $this->Form->control('delegacia');
            echo $this->Form->control('autoridade_requisitante');
            echo $this->Form->control('tipo_logradouro');
            echo $this->Form->control('logradouro');
            echo $this->Form->control('nmr_logradouro');
            echo $this->Form->control('bairro');
            echo $this->Form->control('cidade');
            echo $this->Form->control('n_laudos_expedidos');
            echo $this->Form->control('n_oficio');
            echo $this->Form->control('cargo');
            echo $this->Form->control('observações');
            echo $this->Form->control('vehicles._ids', ['options' => $vehicles]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
