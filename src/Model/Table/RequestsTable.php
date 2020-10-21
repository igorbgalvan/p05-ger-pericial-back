<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Requests Model
 *
 * @property \App\Model\Table\VehiclesTable&\Cake\ORM\Association\BelongsToMany $Vehicles
 *
 * @method \App\Model\Entity\Request get($primaryKey, $options = [])
 * @method \App\Model\Entity\Request newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Request[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Request|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Request saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Request patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Request[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Request findOrCreate($search, callable $callback = null, $options = [])
 */
class RequestsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('requests');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Vehicles', [
            'foreignKey' => 'request_id',
            'targetForeignKey' => 'vehicle_id',
            'joinTable' => 'vehicles_requests',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->date('data_documento')
            ->allowEmptyDateTime('data_documento');

        $validator
            ->date('data_realizacao_pericia')
            ->allowEmptyDateTime('data_realizacao_pericia');

        $validator
            ->date('data_recebimento')
            ->allowEmptyDateTime('data_recebimento');

        $validator
            ->scalar('tipo_pericia')
            ->maxLength('tipo_pericia', 255)
            ->allowEmptyString('tipo_pericia');

        $validator
            ->scalar('exame_pericia')
            ->maxLength('exame_pericia', 255)
            ->allowEmptyString('exame_pericia');

        $validator
            ->scalar('descricao')
            ->maxLength('descricao', 600)
            ->allowEmptyString('descricao');

        $validator
            ->scalar('nome_vitima')
            ->maxLength('nome_vitima', 255)
            ->allowEmptyString('nome_vitima');

        $validator
            ->scalar('n_documento')
            ->maxLength('n_documento', 255)
            ->allowEmptyString('n_documento');

        $validator
            ->scalar('n_bo')
            ->maxLength('n_bo', 255)
            ->allowEmptyString('n_bo');

        $validator
            ->scalar('n_ip')
            ->maxLength('n_ip', 255)
            ->allowEmptyString('n_ip');

        $validator
            ->scalar('outros_proc')
            ->maxLength('outros_proc', 255)
            ->allowEmptyString('outros_proc');

        $validator
            ->scalar('escrivao')
            ->maxLength('escrivao', 255)
            ->allowEmptyString('escrivao');

        $validator
            ->scalar('delegacia')
            ->maxLength('delegacia', 255)
            ->allowEmptyString('delegacia');

        $validator
            ->scalar('autoridade_requisitante')
            ->maxLength('autoridade_requisitante', 255)
            ->allowEmptyString('autoridade_requisitante');

        $validator
            ->scalar('tipo_logradouro')
            ->maxLength('tipo_logradouro', 255)
            ->allowEmptyString('tipo_logradouro');

        $validator
            ->scalar('logradouro')
            ->maxLength('logradouro', 255)
            ->allowEmptyString('logradouro');

        $validator
            ->scalar('nmr_logradouro')
            ->maxLength('nmr_logradouro', 255)
            ->allowEmptyString('nmr_logradouro');

        $validator
            ->scalar('bairro')
            ->maxLength('bairro', 255)
            ->allowEmptyString('bairro');

        $validator
            ->scalar('cidade')
            ->maxLength('cidade', 255)
            ->allowEmptyString('cidade');

        $validator
            ->scalar('n_laudos_expedidos')
            ->maxLength('n_laudos_expedidos', 255)
            ->allowEmptyString('n_laudos_expedidos');

        $validator
            ->scalar('n_oficio')
            ->maxLength('n_oficio', 255)
            ->allowEmptyString('n_oficio');

        $validator
            ->scalar('cargo')
            ->maxLength('cargo', 255)
            ->allowEmptyString('cargo');

        $validator
            ->scalar('observacoes')
            ->maxLength('observacoes', 600)
            ->allowEmptyString('observacoes');

        return $validator;
    }
}
