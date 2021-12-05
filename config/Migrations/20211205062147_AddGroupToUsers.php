<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddGroupToUsers extends AbstractMigration
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
        $table->addColumn(
            'group',
            'enum',
            [
            'values' => ['user', 'administrator'],
            'default' => 'user',
            'after' => 'password',
            'comment' => 'role group',
        ]
        );
        $table->update();
    }
}
