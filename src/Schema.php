<?php
/*
 * +----------------------------------------------------------------------
 * | thinkphp-beautiful-migrate
 * +----------------------------------------------------------------------
 * | Author: King east <1207877378@qq.com>
 * +----------------------------------------------------------------------
 */

namespace ke\migrate;


use Phinx\Db\Adapter\AdapterInterface;
use think\migration\db\Table;

class Schema
{
    protected $table;

    protected $blueprint;

    public function __construct(Table $table, Blueprint $blueprint)
    {
        $this->table = $table;
        $this->blueprint = $blueprint;
    }

    /**
     * 创建蓝图实例
     * @param AdapterInterface $adapter
     * @param string $name 表名
     * @param callable $call 回调
     * @param array $options 表选项
     */
    public static function create(AdapterInterface $adapter, $name, callable $call, array $options = [])
    {
        $table = new Table($name, $options, $adapter);
        $blueprint = new Blueprint();

        call_user_func($call, $blueprint);

        foreach ($blueprint->getColumns() as $name=>$column) {
            if ($blueprint->hasChange($name)) {
                $type = $column['type'];
                unset($column['type']);
                $table->changeColumn($name, $type, $column);
            } else if ($blueprint->hasRemove($name)) {
                $table->removeColumn($name);
            } else if ($newName = $blueprint->getRename($name)) {
                $table->renameColumn($name, $newName);
            } else {
                $type = $column['type'];
                unset($column['type']);
                $table->addColumn($name, $type, $column);
            }
        }
        // 索引
        foreach ($blueprint->getIndexs() as $index) {
            if (isset($index['columns'])) {
                $columns = $index['columns'];
                unset($index['columns']);
                $table->addIndex($columns, $index);
            } else if (isset($index['column'])) {
                $column = $index['column'];
                unset($index['column']);
                $table->addIndex($column, $index);
            }
        }

        $table->create();
    }


    /**
     * 编辑蓝图实例
     * @param AdapterInterface $adapter
     * @param string $name 表名
     * @param callable $call 回调
     * @param array $options 表选项
     */
    public static function table(AdapterInterface $adapter, $name, callable $call, array $options = [])
    {
        $table = new Table($name, $options, $adapter);
        $blueprint = new Blueprint();

        call_user_func($call, $blueprint);

        foreach ($blueprint->getColumns() as $name=>$column) {
            if ($blueprint->hasChange($name)) {
                $type = $column['type'];
                unset($column['type']);
                $table->changeColumn($name, $type, $column);
            } else if ($blueprint->hasRemove($name)) {
                $table->removeColumn($name);
            } else if ($newName = $blueprint->getRename($name)) {
                $table->renameColumn($name, $newName);
            } else {
                $type = $column['type'];
                unset($column['type']);
                $table->addColumn($name, $type, $column);
            }
        }
        // 索引
        foreach ($blueprint->getIndexs() as $index) {
            if (isset($index['columns'])) {
                $columns = $index['columns'];
                unset($index['columns']);
                $table->addIndex($columns, $index);
            } else if (isset($index['column'])) {
                $column = $index['column'];
                unset($index['column']);
                $table->addIndex($column, $index);
            }
        }

        $table->save();
    }

}
