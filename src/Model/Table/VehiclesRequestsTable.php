<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VehiclesRequests Model
 *
 * @property \App\Model\Table\VehiclesTable&\Cake\ORM\Association\BelongsTo $Vehicles
 * @property \App\Model\Table\RequestsTable&\Cake\ORM\Association\BelongsTo $Requests
 *
 * @method \App\Model\Entity\VehiclesRequest get($primaryKey, $options = [])
 * @method \App\Model\Entity\VehiclesRequest newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VehiclesRequest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VehiclesRequest|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehiclesRequest saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehiclesRequest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VehiclesRequest[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VehiclesRequest findOrCreate($search, callable $callback = null, $options = [])
 */
class VehiclesRequestsTable extends Table
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

        $this->setTable('vehicles_requests');
        $this->setDisplayField('vehicle_id');
        $this->setPrimaryKey(['vehicle_id', 'request_id']);

        $this->belongsTo('Vehicles', [
            'foreignKey' => 'vehicle_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Requests', [
            'foreignKey' => 'request_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['vehicle_id'], 'Vehicles'));
        $rules->add($rules->existsIn(['request_id'], 'Requests'));

        return $rules;
    }
}
