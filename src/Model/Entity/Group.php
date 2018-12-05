<?php
namespace Accounts\Model\Entity;

use Cake\ORM\Entity;

/**
 * Group Entity
 *
 * @property int $id
 * @property string $name
 * @property int|null $parent_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $lockhash
 *
 * @property \Accounts\Model\Entity\ParentGroup $parent_group
 * @property \Accounts\Model\Entity\ChildGroup[] $child_groups
 * @property \Accounts\Model\Entity\User[] $users
 */
class Group extends Entity
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
        'name' => true,
        'parent_id' => true,
        'created' => true,
        'modified' => true,
        'lockhash' => true,
        'parent_group' => true,
        'child_groups' => true,
        'users' => true,
    ];
}
