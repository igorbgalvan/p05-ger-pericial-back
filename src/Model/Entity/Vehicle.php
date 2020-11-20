<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vehicle Entity
 *
 * @property int $id
 * @property string|null $marca
 * @property string|null $placa
 * @property string|null $cor
 * @property string|null $tipo_veiculo
 *
 * @property \App\Model\Entity\Request[] $requests
 */
class Vehicle extends Entity
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
        'marca' => true,
        'placa' => true,
        'cor' => true,
        'tipo_veiculo' => true,
        'requests' => true,
    ];
}
