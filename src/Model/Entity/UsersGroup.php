<?php
namespace Accounts\Model\Entity;

use Cake\ORM\Entity;

/**
 * UsersGroup Entity
 *
 * @property int $user_id
 * @property int $group_id
 *
 * @property \Accounts\Model\Entity\User $user
 * @property \Accounts\Model\Entity\Group $group
 */
class UsersGroup extends Entity
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
        'user' => true,
        'group' => true
    ];
}
