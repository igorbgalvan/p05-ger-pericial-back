<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Request Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime|null $data_documento
 * @property \Cake\I18n\FrozenTime|null $data_realização_perícia
 * @property \Cake\I18n\FrozenTime|null $data_recebimento
 * @property string|null $tipo_pericia
 * @property string|null $exame_pericia
 * @property string|null $descrição
 * @property string|null $nome_vitima
 * @property string|null $n_documento
 * @property string|null $n_bo
 * @property string|null $n_ip
 * @property string|null $outros_proc
 * @property string|null $escrivao
 * @property string|null $delegacia
 * @property string|null $autoridade_requisitante
 * @property string|null $tipo_logradouro
 * @property string|null $logradouro
 * @property string|null $nmr_logradouro
 * @property string|null $bairro
 * @property string|null $cidade
 * @property string|null $n_laudos_expedidos
 * @property string|null $n_oficio
 * @property string|null $cargo
 * @property string|null $observações
 *
 * @property \App\Model\Entity\Vehicle[] $vehicles
 */
class Request extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'data_documento' => true,
        'data_realizacao_pericia' => true,
        'data_recebimento' => true,
        'tipo_pericia' => true,
        'exame_pericia' => true,
        'descricao' => true,
        'nome_vitima' => true,
        'n_documento' => true,
        'n_bo' => true,
        'n_ip' => true,
        'outros_proc' => true,
        'escrivao' => true,
        'delegacia' => true,
        'autoridade_requisitante' => true,
        'tipo_logradouro' => true,
        'logradouro' => true,
        'nmr_logradouro' => true,
        'bairro' => true,
        'cidade' => true,
        'n_laudos_expedidos' => true,
        'n_oficio' => true,
        'cargo' => true,
        'observacoes' => true,
        'vehicles' => true,
    ];
}
