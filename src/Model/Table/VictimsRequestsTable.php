<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VictimsRequests Model
 *
 * @property \App\Model\Table\VictimsTable&\Cake\ORM\Association\BelongsTo $Victims
 * @property \App\Model\Table\RequestsTable&\Cake\ORM\Association\BelongsTo $Requests
 *
 * @method \App\Model\Entity\VictimsRequest get($primaryKey, $options = [])
 * @method \App\Model\Entity\VictimsRequest newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VictimsRequest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VictimsRequest|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VictimsRequest saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VictimsRequest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VictimsRequest[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VictimsRequest findOrCreate($search, callable $callback = null, $options = [])
 */
class VictimsRequestsTable extends Table
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

        $this->setTable('victims_requests');
        $this->setDisplayField('victim_id');
        $this->setPrimaryKey(['victim_id', 'request_id']);

        $this->belongsTo('Victims', [
            'foreignKey' => 'victim_id',
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
        $rules->add($rules->existsIn(['victim_id'], 'Victims'));
        $rules->add($rules->existsIn(['request_id'], 'Requests'));

        return $rules;
    }
}
