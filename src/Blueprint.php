<?php
/*
 * +----------------------------------------------------------------------
 * | thinkphp-beautiful-migrate
 * +----------------------------------------------------------------------
 * | Author: King east <1207877378@qq.com>
 * +----------------------------------------------------------------------
 */

namespace ke\migrate;


use Phinx\Db\Adapter\MysqlAdapter;

class Blueprint
{

    /**
     * 当前操作字段
     * @var string
     */
    protected $actionName = '';

    /**
     * 字段配置
     * @var array
     */
    protected $columns = [];

    /**
     * 字段默认值
     * @var array
     */
    protected $defaults = [];

    /**
     * 为null的字段
     * @var array
     */
    protected $nullables = [];

    /**
     * 字段注释
     * @var array
     */
    protected $comments = [];

    /**
     * 要修改的字段
     * @var array
     */
    protected $changes = [];

    /**
     * 要删除的字段
     * @var array
     */
    protected $removes = [];

    /**
     * 要改名的字段
     * @var array
     */
    protected $renames = [];

    /**
     * 索引设置
     * @var array
     */
    protected $index = [];

    /**
     * 获取字段列表
     * @return array
     */
    public function getColumns()
    {
        $list = [];
        foreach ($this->columns as $name=>$column) {
            if (isset($this->defaults[$name])) {
                $column['default'] = $this->defaults[$name];
            }
            if (isset($this->nullables[$name])) {
                $column['null'] = $this->nullables[$name];
            }
            if (isset($this->comments[$name])) {
                $column['comment'] = $this->comments[$name];
            }
            $list[$name] = $column;
        }
        return $list;
    }

    /**
     * 是否要修改字段
     * @param $name
     * @return bool
     */
    public function hasChange($name)
    {
        return isset($this->changes[$name]);
    }

    /**
     * 字段唯一
     * @return array
     */
    public function getIndexs()
    {
        return $this->index;
    }

    /**
     * 字段唯一
     * @param $columns
     * @param $name
     * @return $this
     */
    public function unique($columns = null, $name = null)
    {
        if (is_null($columns)) {
            $this->index[] = [
                'column'=>$this->actionName,
                'name'=>$name ?: $this->actionName,
                'unique'=>true,
            ];
        } else if (is_array($columns)) {
            $this->index[] = [
                'columns'=>$columns,
                'name'=>$name,
                'unique'=>true,
            ];
        } else {
            $this->index[] = [
                'column'=>$columns,
                'name'=>$name ?: $this->actionName,
                'unique'=>true,
            ];
        }

        return $this;
    }

    /**
     * 字段索引
     * @param $columns
     * @param $name
     * @param array $options
     * @return $this
     */
    public function index($columns = null, $name = null, array $options = [])
    {
        if (is_null($columns)) {
            $this->index[] = [
                'column'=>$this->actionName,
                'name'=>$name ?: $this->actionName,
            ] + $options;
        } else if (is_array($columns)) {
            $this->index[] = [
                'columns'=>$columns,
                'name'=>$name,
            ] + $options;
        } else {
            $this->index[] = [
                'column'=>$columns,
                'name'=>$name ?: $this->actionName,
            ] + $options;
        }

        return $this;
    }

    /**
     * 是否要删除字段
     * @param $name
     * @return bool
     */
    public function hasRemove($name)
    {
        return isset($this->removes[$name]);
    }

    /**
     * 删除字段
     * @param $name
     * @return $this
     */
    public function remove($name)
    {
        $this->columns[$name] = [];
        $this->removes[$name] = true;
        return $this;
    }

    /**
     * 要修改的字段名
     * @param $name
     * @return string|null
     */
    public function getRename($name)
    {
        return isset($this->renames[$name]) ? $this->renames[$name] : null;
    }

    /**
     * 修改字段名
     * @param $name
     * @param $newName
     * @return $this
     */
    public function rename($name, $newName)
    {
        $this->renames[$name] = $newName;
        return $this;
    }

    /**
     * 相当于 BIGINT
     * @param string $name
     * @param bool $autoIncrement
     * @param bool $unsigned
     * @return $this
     */
    public function bigInteger($name, $autoIncrement = false, $unsigned = false)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_INTEGER,
            'limit'=>MysqlAdapter::INT_BIG,
            'identity'=>$autoIncrement,
            'signed'=>!$unsigned,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 BLOB
     * @param string $name
     * @return $this
     */
    public function binary($name)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_BLOB,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 BOOLEAN
     * @param string $name
     * @return $this
     */
    public function boolean($name)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_BOOLEAN,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于带有长度的 CHAR
     * @param string $name
     * @param int $length
     * @return $this
     */
    public function char($name, $length)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_CHAR,
            'limit'=>$length,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 DATE
     * @param string $name
     * @return $this
     */
    public function date($name)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_DATE,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 DATETIME
     * @param string $name
     * @return $this
     */
    public function dateTime($name)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_DATETIME,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于带有精度与基数 DECIMAL
     * @param string $name
     * @param int $length 整数精度
     * @param int $places 小数精度
     * @param bool $unsigned 是否无符号
     * @return $this
     */
    public function decimal($name, $length = 11, $places = 2, $unsigned = false)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_DECIMAL,
            'precision'=>$length,
            'scale'=>$places,
            'signed'=>!$unsigned,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 ENUM
     * @param string $name
     * @param array $values
     * @return $this
     */
    public function enum($name, array $values)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_ENUM,
            'values'=>$values,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 GEOMETRY
     * @param string $name
     * @return $this
     */
    public function geometry($name)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_GEOMETRY,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 INTEGER
     * @param string $name
     * @param bool $autoIncrement
     * @param bool $unsigned
     * @return $this
     */
    public function integer($name, $autoIncrement = false, $unsigned = false)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_INTEGER,
            'identity'=>$autoIncrement,
            'signed'=>!$unsigned,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 JSON
     * @param string $name
     * @return $this
     */
    public function json($name)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_JSON,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 JSONB
     * @param string $name
     * @return $this
     */
    public function jsonb($name)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_JSONB,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 LINESTRING
     * @param string $name
     * @return $this
     */
    public function lineString($name)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_LINESTRING,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 LONGTEXT
     * @param string $name
     * @return $this
     */
    public function longText($name)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_TEXT,
            'limit'=>MysqlAdapter::TEXT_LONG,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 MEDIUMINT
     * @param string $name
     * @param bool $autoIncrement
     * @param bool $unsigned
     * @return $this
     */
    public function mediumInteger($name, $autoIncrement = false, $unsigned = false)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_INTEGER,
            'limit'=>MysqlAdapter::INT_MEDIUM,
            'identity'=>$autoIncrement,
            'signed'=>!$unsigned,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 MEDIUMTEXT
     * @param string $name
     * @return $this
     */
    public function mediumText($name)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_TEXT,
            'limit'=>MysqlAdapter::TEXT_MEDIUM,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于可空版本的 timestamps() 字段
     * @param string $name
     * @return $this
     */
    public function nullableTimestamps($name)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_TIMESTAMP,
        ];
        $this->nullables[$name] = true;
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 POINT
     * @param string $name
     * @return $this
     */
    public function point($name)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_POINT,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 POLYGON
     * @param string $name
     * @return $this
     */
    public function polygon($name)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_POLYGON,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 SMALLINT
     * @param string $name
     * @param bool $autoIncrement
     * @param bool $unsigned
     * @return $this
     */
    public function smallInteger($name, $autoIncrement = false, $unsigned = false)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_INTEGER,
            'limit'=>MysqlAdapter::INT_SMALL,
            'identity'=>$autoIncrement,
            'signed'=>!$unsigned,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于为软删除添加一个可空的 deleted_at 字段
     * @return $this
     */
    public function softDeletes()
    {
        $name = 'delete_time';
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_INTEGER,
        ];
        $this->nullables[$name] = true;
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于带长度的 VARCHAR
     * @param string $name
     * @param int $length
     * @return $this
     */
    public function string($name, $length)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_STRING,
            'limit'=>$length,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于带长度的 TEXT
     * @param string $name
     * @return $this
     */
    public function text($name)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_TEXT,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于带长度的 TIME
     * @param string $name
     * @return $this
     */
    public function time($name)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_TIME,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于带长度的 TIMESTAMP
     * @param string $name
     * @return $this
     */
    public function timestamp($name)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_TIMESTAMP,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于可空的 create_time 和 update_time BigInteger
     * @return $this
     */
    public function timestamps()
    {
        $this->bigInteger('create_time', false, true);
        $this->defaults['create_time'] = 0;
        $this->bigInteger('update_time', false, true);
        $this->defaults['update_time'] = 0;

        return $this;
    }

    /**
     * 相当于 TINYINT
     * @param string $name
     * @param bool $autoIncrement
     * @param bool $unsigned
     * @return $this
     */
    public function tinyInteger($name, $autoIncrement = false, $unsigned = false)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_INTEGER,
            'limit'=>MysqlAdapter::INT_TINY,
            'identity'=>$autoIncrement,
            'signed'=>!$unsigned,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 Unsigned BIGINT
     * @param string $name
     * @return $this
     */
    public function unsignedBigInteger($name)
    {
        $this->bigInteger($name, false, true);

        return $this;
    }

    /**
     * 相当于带有精度和基数的 UNSIGNED DECIMAL
     * @param string $name
     * @param int $length
     * @param int $places
     * @return $this
     */
    public function unsignedDecimal($name, $length = 11, $places = 2)
    {
        $this->decimal($name, $length, $places, true);

        return $this;
    }

    /**
     * 相当于 Unsigned INT
     * @param string $name
     * @return $this
     */
    public function unsignedInteger($name)
    {
        $this->integer($name, false, true);

        return $this;
    }

    /**
     * 相当于 Unsigned MEDIUMINT
     * @param string $name
     * @return $this
     */
    public function unsignedMediumInteger($name)
    {
        $this->mediumInteger($name, false, true);

        return $this;
    }

    /**
     * 相当于 Unsigned SMALLINT
     * @param string $name
     * @return $this
     */
    public function unsignedSmallInteger($name)
    {
        $this->smallInteger($name, false, true);

        return $this;
    }

    /**
     * 相当于 Unsigned TINYINT
     * @param string $name
     * @return $this
     */
    public function unsignedTinyInteger($name)
    {
        $this->tinyInteger($name, false, true);

        return $this;
    }

    /**
     * 相当于 UUID
     * @param string $name
     * @return $this
     */
    public function uuid($name = 'uuid')
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::PHINX_TYPE_UUID,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 相当于 YEAR
     * @param string $name
     * @return $this
     */
    public function year($name)
    {
        $this->columns[$name] = [
            'type'=>MysqlAdapter::TYPE_YEAR,
        ];
        $this->actionName = $name;

        return $this;
    }

    /**
     * 设置字段默认值
     * @param $value
     * @return $this
     */
    public function default($value)
    {
        $this->defaults[$this->actionName] = $value;
        return $this;
    }

    /**
     * 配置字段是否可null
     * @param bool $value
     * @return $this
     */
    public function nullable($value = true)
    {
        $this->nullables[$this->actionName] = $value;
        return $this;
    }

    /**
     * 配置字段注释
     * @param string $string
     * @return $this
     */
    public function comment($string)
    {
        $this->comments[$this->actionName] = $string;
        return $this;
    }

    /**
     * 标记字段为修改
     * @return $this
     */
    public function change()
    {
        $this->changes[$this->actionName] = true;
        return $this;
    }

}
