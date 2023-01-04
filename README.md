## thinkphp-beautiful-migrate

一个易使用、漂亮的数据库迁移代码构建器

* 支持Thinkphp6.0.x

### 安装

```
composer require ke/thinkphp-beautiful-migrate
```

### 使用

```
// 创建表
Schema::create($this->getAdapter(), '表名', function (Blueprint $blueprint) {
    // 迁移代码
});

// 修改表
Schema::table($this->getAdapter(), '表名', function (Blueprint $blueprint) {
    // 迁移代码
});
```

### 可用的字段定义方法

| 命令                                           | 描述                                         |
|----------------------------------------------|--------------------------------------------|
| $blueprint->id();                            | 定义一个bigint 并命名为id的主键                       |
| $blueprint->bigInteger('votes');             | 相当于 BIGINT                                 |
| $blueprint->binary('data');                  | 相当于 BLOB                                   |
| $blueprint->boolean('confirmed');            | 相当于 BOOLEAN                                |
| $blueprint->char('name', 100);               | 相当于带有长度的 CHAR                              |
| $blueprint->date('created_at');              | 相当于 DATE                                   |
| $blueprint->dateTime('created_at');          | 相当于 DATETIME                               |
| $blueprint->decimal('amount', 8, 2);         | 相当于带有精度与基数 DECIMAL                         |
| $blueprint->enum('level', ['easy', 'hard']); | 相当于 ENUM                                   |
| $blueprint->geometry('positions');           | 相当于 GEOMETRY                               |
| $blueprint->integer('votes');                | 相当于 INTEGER                                |
| $blueprint->json('options');                 | 相当于 JSON                                   |
| $blueprint->jsonb('options');                | 相当于 JSONB                                  |
| $blueprint->lineString('positions');         | 相当于 LINESTRING                             |
| $blueprint->longText('description');         | 相当于 LONGTEXT                               |
| $blueprint->mediumInteger('votes');          | 相当于 MEDIUMINT                              |
| $blueprint->mediumText('description');       | 相当于 MEDIUMTEXT                             |
| $blueprint->point('position');               | 相当于 POINT                                  |
| $blueprint->polygon('positions');            | 相当于 POLYGON                                |
| $blueprint->smallInteger('votes');           | 相当于 SMALLINT                               |
| $blueprint->softDeletes();                   | 相当于为软删除添加一个可空的 delete_time 字段              |
| $blueprint->string('name', 100);             | 相当于带长度的 VARCHAR                            |
| $blueprint->text('description');             | 相当于 TEXT                                   |
| $blueprint->time('sunrise');                 | 相当于 TIME                                   |
| $blueprint->timestamp('added_on');           | 相当于 TIMESTAMP                              |
| $blueprint->timestamps();                    | 相当于可空的 create_time 和 update_time TIMESTAMP |
| $blueprint->tinyInteger('votes');            | 相当于 TINYINT                                |
| $blueprint->unsignedBigInteger('votes');     | 相当于 Unsigned BIGINT                        |
| $blueprint->unsignedDecimal('amount', 8, 2); | 相当于带有精度和基数的 UNSIGNED DECIMAL               |
| $blueprint->unsignedInteger('votes');        | 相当于 Unsigned INT                           |
| $blueprint->unsignedMediumInteger('votes');  | 相当于 Unsigned MEDIUMINT                     |
| $blueprint->unsignedSmallInteger('votes');   | 相当于 Unsigned SMALLINT                      |
| $blueprint->unsignedTinyInteger('votes');    | 相当于 Unsigned TINYINT                       |
| $blueprint->uuid('id');                      | 相当于 UUID                                   |
| $blueprint->year('birth_year');              | 相当于 YEAR                                   |

[查看使用示例](./example/20210304140550_admin.php)

QQ交流群：942503490

by King east
