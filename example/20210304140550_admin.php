<?php

use think\migration\Migrator;
use ke\migrate\Schema;
use ke\migrate\Blueprint;

class Admin extends Migrator
{

    public function up()
    {
        Schema::create($this->getAdapter(), 'test', function (Blueprint $blueprint) {
            $blueprint->string('username', 64)->comment('用户名');
            $blueprint->string('password', 255)->comment('登录密码');
            $blueprint->integer('integer', false, true);
            $blueprint->integer('integer2', false, false);
            $blueprint->decimal('money', 11, 2);
            $blueprint->decimal('money2', 10, 2, true);

            $blueprint->string('avatar', 255)->comment('头像');
            $blueprint->tinyInteger('sex')->default(0);
            $blueprint->bigInteger('bigInt')->comment('大整数');
            $blueprint->date('date')->nullable();
            $blueprint->timestamps();

            $blueprint->uuid();

            $blueprint->index(['username', 'sex']);
        }, ['comment'=>'表注释']);
    }

    public function down()
    {
        $this->dropTable('test');
    }
}
