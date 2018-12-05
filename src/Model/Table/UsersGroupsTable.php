<?php
namespace Accounts\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Custom\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsersGroups Model
 *
 * @property \Accounts\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \Accounts\Model\Table\GroupsTable|\Cake\ORM\Association\BelongsTo $Groups
 *
 * @method \Accounts\Model\Entity\UsersGroup get($primaryKey, $options = [])
 * @method \Accounts\Model\Entity\UsersGroup newEntity($data = null, array $options = [])
 * @method \Accounts\Model\Entity\UsersGroup[] newEntities(array $data, array $options = [])
 * @method \Accounts\Model\Entity\UsersGroup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Accounts\Model\Entity\UsersGroup|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Accounts\Model\Entity\UsersGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Accounts\Model\Entity\UsersGroup[] patchEntities($entities, array $data, array $options = [])
 * @method \Accounts\Model\Entity\UsersGroup findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersGroupsTable extends Table
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

        $this->setTable('users_groups');
        $this->setDisplayField('user_id');
        $this->setPrimaryKey(['user_id', 'group_id']);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Accounts.Users'
        ]);
        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER',
            'className' => 'Accounts.Groups'
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['group_id'], 'Groups'));

        return $rules;
    }
}
