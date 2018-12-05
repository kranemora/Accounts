<?php
namespace Accounts\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string|null $given_name
 * @property string|null $last_name
 * @property string|null $first_name
 * @property string|null $middle_name
 * @property string|null $paternal_surname
 * @property string|null $maternal_surname
 * @property string $full_name
 * @property string $email
 * @property string|null $picture
 * @property int $group_id
 * @property string|null $token
 * @property bool $activated
 * @property bool $enabled
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $lockhash
 *
 * @property \Accounts\Model\Entity\Group[] $groups
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
        'username' => true,
        'password' => true,
        'given_name' => true,
        'last_name' => true,
        'first_name' => true,
        'middle_name' => true,
        'paternal_surname' => true,
        'maternal_surname' => true,
        'full_name' => true,
        'email' => true,
        'picture' => true,
        'group_id' => true,
        'token' => true,
        'activated' => true,
        'enabled' => true,
        'created' => true,
        'modified' => true,
        'lockhash' => true,
        'groups' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
        'token'
    ];
}
