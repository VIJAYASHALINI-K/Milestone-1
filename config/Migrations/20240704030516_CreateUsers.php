<?php
use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 40,            
            'null' => false,
        ]);
        $table->addColumn('password', 'string', [
            'default' => null,
            'limit' => 255,
        ]);
        $table->addColumn('username', 'string', [
            'default' => null,
            'limit' => 8,
        ]);
        $table->addColumn('gender', 'string', [
            'default' => null,
            'limit' => 7,
        ]);
        $table->addColumn('hobbies', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('interests', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addIndex([
            'email',
        ], [
            'name' => 'BY_EMAIL',
            'unique' => false,
        ]);
        $table->create();
    }
}
