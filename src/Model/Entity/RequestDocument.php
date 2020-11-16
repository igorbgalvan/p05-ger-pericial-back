<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RequestDocument Entity
 *
 * @property int $id
 * @property int $request_id
 * @property string $doc_name
 * @property string $title
 *
 * @property \App\Model\Entity\Request $request
 */
class RequestDocument extends Entity
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
        'request_id' => true,
        'doc_name' => true,
        'title' => true,
        'request' => true,
    ];
}
