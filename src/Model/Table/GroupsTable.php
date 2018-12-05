<?php
namespace Accounts\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Custom\ORM\Table;
use Cake\Validation\Validator;

/**
 * Groups Model
 *
 * @property \Accounts\Model\Table\GroupsTable|\Cake\ORM\Association\BelongsTo $ParentGroups
 * @property \Accounts\Model\Table\GroupsTable|\Cake\ORM\Association\HasMany $ChildGroups
 * @property \Accounts\Model\Table\UsersTable|\Cake\ORM\Association\HasMany $Users
 * @property \Accounts\Model\Table\UsersTable|\Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \Accounts\Model\Entity\Group get($primaryKey, $options = [])
 * @method \Accounts\Model\Entity\Group newEntity($data = null, array $options = [])
 * @method \Accounts\Model\Entity\Group[] newEntities(array $data, array $options = [])
 * @method \Accounts\Model\Entity\Group|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Accounts\Model\Entity\Group|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Accounts\Model\Entity\Group patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Accounts\Model\Entity\Group[] patchEntities($entities, array $data, array $options = [])
 * @method \Accounts\Model\Entity\Group findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GroupsTable extends Table
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

        $this->setTable('groups');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ParentGroups', [
            'className' => 'Accounts.Groups',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildGroups', [
            'className' => 'Accounts.Groups',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'group_id',
            'className' => 'Accounts.Users'
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'group_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'users_groups',
            'className' => 'Accounts.Users',
            'through' => 'Accounts.UsersGroups'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('lockhash')
            ->maxLength('lockhash', 32)
            ->requirePresence('lockhash', 'create')
            ->notEmpty('lockhash');

        return $validator;
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
        $rules->add($rules->existsIn(['parent_id'], 'ParentGroups'));

        return $rules;
    }
}
