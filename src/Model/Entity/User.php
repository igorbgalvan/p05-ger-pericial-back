<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $position
 * @property string $phone
 * @property int $role_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property bool $confirmation
 * @property string $email_confirmed
 * @property bool $actived
 * @property string|null $profile_picture
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Log[] $logs
 * @property \App\Model\Entity\Report[] $reports
 * @property \App\Model\Entity\Request[] $requests
 * @property \App\Model\Entity\Token[] $tokens
 */
class User extends Entity
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
        'email' => true,
        'password' => true,
        'name' => true,
        'position' => true,
        'phone' => true,
        'role_id' => true,
        'created' => true,
        'modified' => true,
        'confirmation' => true,
        'email_confirmed' => true,
        'actived' => true,
        'profile_picture' => true,
        'role' => true,
        'logs' => true,
        'reports' => true,
        'requests' => true,
        'tokens' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
}
