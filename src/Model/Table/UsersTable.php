<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
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
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    // public function validationDefault(Validator $validator)
    // {
    //     $validator
    //         ->integer('id')
    //         ->allowEmptyString('id', null, 'create');

    //     $validator
    //         ->email('email')
    //         ->requirePresence('email', 'create')
    //         ->notEmptyString('email')
    //         ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

    //     $validator
    //         ->scalar('password')
    //         ->minLength('password', 8)
    //         ->maxLength('password', 15)
    //         ->requirePresence('password', 'create')
    //         ->notEmptyString('password');

    //     $validator
    //         ->add('username', 'validUserName',[
    //             'rule' => 'isValidUsername',
    //             'message' => __('username contains letters followed by whitespace follwed by letter'),
    //             'provider' => 'table',
    //             ])            
    //         ->requirePresence('username', 'create')
    //         ->notEmptyString('username');

    //     $validator
    //         ->scalar('gender')
    //         ->minLength('gender',4)
    //         ->maxLength('gender', 6)
    //         ->requirePresence('gender', 'create')
    //         ->notEmptyString('gender');

    //     $validator
    //         ->scalar('hobbies')
    //         ->minLength('hobbies',40)
    //         ->maxLength('hobbies', 255)
    //         ->requirePresence('hobbies', 'create')
    //         ->notEmptyString('hobbies');

    //     $validator
    //         ->scalar('interests')
    //         ->minLength('interests',40)
    //         ->maxLength('interests', 255)
    //         ->requirePresence('interests', 'create')
    //         ->notEmptyString('interests');

    //     return $validator;
    // }
    // public function isValidUsername($value, array $context) {           
    //     if(preg_match("/^[A-Z]{1}[A-Za-z]{2,8}\s{1}[A-Z]{1,3}$/",$value)){
    //         return true;
    //     }
    //     else{
    //         return "Username starts with uppercase letter followed by letters, whitespace and letter";
    //     }
    // }

    
    // public function validationEmail(Validator $validator)
    // {
    //     $validator
    //         ->email('email')
    //         ->requirePresence('email', 'create')
    //         ->notEmptyString('email')
    //         ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);
    //         return $validator;
    // }
    // public function validationPassword(Validator $validator)
    // {
    //     $validator
    //         ->scalar('password')
    //         ->minLength('password', 8)
    //         ->maxLength('password', 15)
    //         ->requirePresence('password', 'create')
    //         ->notEmptyString('password');
    //         return $validator;
    // }
    // public function validationUsername(Validator $validator)
    // {
    //     $validator
    //         ->add('username', 'validUserName',[
    //             'rule' => 'isValidUsername',
    //             'message' => __('username contains letters followed by whitespace follwed by letter'),
    //             'provider' => 'table',
    //             ])            
    //         ->requirePresence('username', 'create')
    //         ->notEmptyString('username');
    //     return $validator;
    // }
    // public function validationGender(Validator $validator)
    // {
    //     $validator
    //         ->scalar('gender')
    //         ->minLength('gender',4)
    //         ->maxLength('gender', 6)
    //         ->requirePresence('gender', 'create')
    //         ->notEmptyString('gender');
    //     return $validator;
    // }
    // public function validationHobbies(Validator $validator)
    // {   
    //     $validator
    //         ->scalar('hobbies')
    //         ->minLength('hobbies',40)
    //         ->maxLength('hobbies', 255)
    //         ->requirePresence('hobbies', 'create')
    //         ->notEmptyString('hobbies');
    //     return $validator;
    // }
    // public function validationInterests(Validator $validator)
    // {
    //     $validator
    //         ->scalar('interests')
    //         ->minLength('interests',40)
    //         ->maxLength('interests', 255)
    //         ->requirePresence('interests', 'create')
    //         ->notEmptyString('interests');
    //     return $validator;
    // }
     public function validationDefault(Validator $validator)
    {
        // $validator
        //     ->integer('id');

        // $validator
        //     ->email('email');

        // $validator
        //     ->scalar('password');

        // $validator
        //     ->scalar('username');

        // $validator
        //     ->scalar('gender');

        // $validator
        //     ->scalar('hobbies');

        // $validator
        //     ->scalar('interests');

        return $validator;
    }
    public function validationStep1(Validator $validator)
    {
        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);
        $validator
            ->scalar('password')
            ->minLength('password', 8)
            ->maxLength('password', 15)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');
            return $validator;
    }
    public function validationStep2(Validator $validator)
    {
        $validator
            ->add('username', 'validUserName',[
                'rule' => 'isValidUsername',
                'message' => __('username contains letters followed by whitespace follwed by letter'),
                'provider' => 'table',
                ])            
            ->requirePresence('username', 'create')
            ->notEmptyString('username');
        $validator
            ->scalar('gender')
            ->minLength('gender',4)
            ->maxLength('gender',6)
            ->requirePresence('gender', 'create')
            ->notEmptyString('gender');
        return $validator;
    }
    public function validationStep3(Validator $validator)
    {   
        $validator
            ->scalar('hobbies')
            ->minLength('hobbies',40)
            ->maxLength('hobbies', 255)
            ->requirePresence('hobbies', 'create')
            ->notEmptyString('hobbies');
 
        $validator
            ->scalar('interests')
            ->minLength('interests',40)
            ->maxLength('interests', 255)
            ->requirePresence('interests', 'create')
            ->notEmptyString('interests');
        return $validator;
    }
    public function isValidUsername($value, array $context) {           
        if(preg_match("/^[A-Z]{1}[A-Za-z]{2,8}\s{1}[A-Z]{1,3}$/",$value)){
            // \s{1}
            return true;
        }
        else{
            return "Username starts with uppercase letter followed by letters, whitespace and letter";
        }
    }
    
    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    // public function buildRules(RulesChecker $rules)
    // {
    //     $rules->add($rules->isUnique(['email']));
    //     $rules->add($rules->isUnique(['username']));

    //     return $rules;
    // }
}




