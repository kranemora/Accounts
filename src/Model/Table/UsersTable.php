<?php
namespace Accounts\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Custom\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Accounts\Model\Table\GroupsTable|\Cake\ORM\Association\BelongsTo $Groups
 * @property \Accounts\Model\Table\GroupsTable|\Cake\ORM\Association\BelongsToMany $Groups
 *
 * @method \Accounts\Model\Entity\User get($primaryKey, $options = [])
 * @method \Accounts\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \Accounts\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \Accounts\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Accounts\Model\Entity\User|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Accounts\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Accounts\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \Accounts\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER',
            'className' => 'Accounts.Groups'
        ]);
        $this->belongsToMany('Groups', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'group_id',
            'joinTable' => 'users_groups',
            'className' => 'Accounts.Groups',
            'through' => 'Accounts.UsersGroups',
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
            ->scalar('username')
            ->maxLength('username', 255)
            ->requirePresence('username', 'create')
            ->notEmpty('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmpty('password', NULL, 'create')
			->add('password', [
				'lengthBetween' => [
				    'rule' => ['lengthBetween', 4, 255],
				    'message' => 'El campo debe contener entre 6 y 255 caracteres.',
				],
			]);

        $validator
            ->scalar('confirm_password')
            ->maxLength('confirm_password', 255)
            ->requirePresence('confirm_password', 'create')
            ->notEmpty('confirm_password', 'La contraseña ingresada requiere confirmación', function ($context) {
                return (isset($context['data']['password']) && strlen($context['data']['password']) != 0);
            })
			->add('confirm_password', [
				'compareWith' => [
				    'rule' => ['compareWith', 'password'],
                    'message' => 'El valor del campo con coincide con la contraseña ingresada.'
				],
			]);
        
        $validator
            ->scalar('given_name')
            ->maxLength('given_name', 255)
            ->allowEmpty('given_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->allowEmpty('last_name');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->allowEmpty('first_name');

        $validator
            ->scalar('middle_name')
            ->maxLength('middle_name', 255)
            ->allowEmpty('middle_name');

        $validator
            ->scalar('paternal_surname')
            ->maxLength('paternal_surname', 255)
            ->allowEmpty('paternal_surname');

        $validator
            ->scalar('maternal_surname')
            ->maxLength('maternal_surname', 255)
            ->allowEmpty('maternal_surname');

        $validator
            ->scalar('full_name')
            ->maxLength('full_name', 255)
            ->requirePresence('full_name', 'create')
            ->notEmpty('full_name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('picture')
            ->maxLength('picture', 255)
            ->allowEmpty('picture');

        $validator
            ->scalar('token')
            ->maxLength('token', 40)
            ->allowEmpty('token');

        $validator
            ->boolean('activated')
            ->requirePresence('activated', 'create')
            ->notEmpty('activated');

        $validator
            ->boolean('enabled')
            ->requirePresence('enabled', 'create')
            ->notEmpty('enabled');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['group_id'], 'Groups'));

        return $rules;
    }
}
