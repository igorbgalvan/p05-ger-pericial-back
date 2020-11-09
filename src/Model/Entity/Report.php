<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Report Entity
 *
 * @property int $id
 * @property string|null $report_id
 * @property \Cake\I18n\FrozenDate|null $delivery_date
 * @property int $user_id
 * @property int|null $request_id
 * @property string|null $position
 * @property string|null $receiver
 * @property string|null $status
 *
 * @property \App\Model\Entity\Report[] $reports
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Request $request
 */
class Report extends Entity
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
        'report_id' => true,
        'delivery_date' => true,
        'user_id' => true,
        'request_id' => true,
        'position' => true,
        'receiver' => true,
        'status' => true,
        'reports' => true,
        'user' => true,
        'request' => true,
    ];
}
