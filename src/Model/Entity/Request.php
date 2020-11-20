<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Request Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate|null $data_documento
 * @property int $user_id
 * @property \Cake\I18n\FrozenDate|null $data_realizacao_pericia
 * @property \Cake\I18n\FrozenDate|null $data_recebimento
 * @property string|null $tipo_pericia
 * @property string|null $tipo_ocorrencia
 * @property string|null $tipo_requisicao
 * @property string|null $exame_pericia
 * @property string|null $descricao
 * @property string|null $descricao_oficio
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
 * @property string|null $observacoes
 * @property bool|null $concluido
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Report[] $reports
 * @property \App\Model\Entity\RequestDocument[] $request_documents
 * @property \App\Model\Entity\Vehicle[] $vehicles
 * @property \App\Model\Entity\Victim[] $victims
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
        'user_id' => true,
        'data_realizacao_pericia' => true,
        'data_recebimento' => true,
        'tipo_pericia' => true,
        'tipo_ocorrencia' => true,
        'tipo_requisicao' => true,
        'exame_pericia' => true,
        'descricao' => true,
        'descricao_oficio' => true,
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
        'observacoes' => true,
        'concluido' => true,
        'user' => true,
        'reports' => true,
        'request_documents' => true,
        'vehicles' => true,
        'victims' => true,
    ];
}
