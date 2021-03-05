## thinkphp-beautiful-migrate

一个易使用、漂亮的数据库迁移代码构建器

### 安装

```
composer require thinkphp-beautiful-migrate
```

### 使用

```
Schema::create($this->getAdapter(), '表名', function (Blueprint $blueprint) {
    // 迁移代码
});
```

### 可用的字段定义方法

| 命令                                     | 描述                                                    |
| ---------------------------------------- | ------------------------------------------------------- |
| $table->bigInteger('votes');             | 相当于 BIGINT                                           |
| $table->binary('data');                  | 相当于 BLOB                                             |
| $table->boolean('confirmed');            | 相当于 BOOLEAN                                          |
| $table->char('name', 100);               | 相当于带有长度的 CHAR                                   |
| $table->date('created_at');              | 相当于 DATE                                             |
| $table->dateTime('created_at');          | 相当于 DATETIME                                         |
| $table->decimal('amount', 8, 2);         | 相当于带有精度与基数 DECIMAL                            |
| $table->enum('level', ['easy', 'hard']); | 相当于 ENUM                                             |
| $table->geometry('positions');           | 相当于 GEOMETRY                                         |
| $table->integer('votes');                | 相当于 INTEGER                                          |
| $table->json('options');                 | 相当于 JSON                                             |
| $table->jsonb('options');                | 相当于 JSONB                                            |
| $table->lineString('positions');         | 相当于 LINESTRING                                       |
| $table->longText('description');         | 相当于 LONGTEXT                                         |
| $table->mediumInteger('votes');          | 相当于 MEDIUMINT                                        |
| $table->mediumText('description');       | 相当于 MEDIUMTEXT                                       |
| $table->morphs('taggable');              | 相当于加入递增的 taggable_id 与字符串 taggable_type     |
| $table->point('position');               | 相当于 POINT                                            |
| $table->polygon('positions');            | 相当于 POLYGON                                          |
| $table->smallIncrements('id');           | 递增 ID (主键) ，相当于「UNSIGNED SMALL INTEGER」       |
| $table->smallInteger('votes');           | 相当于 SMALLINT                                         |
| $table->softDeletes();                   | 相当于为软删除添加一个可空的 deleted_at 字段            |
| $table->string('name', 100);             | 相当于带长度的 VARCHAR                                  |
| $table->text('description');             | 相当于 TEXT                                             |
| $table->time('sunrise');                 | 相当于 TIME                                             |
| $table->timestamp('added_on');           | 相当于 TIMESTAMP                                        |
| $table->timestamps();                    | 相当于可空的 create_time 和 update_time TIMESTAMP         |
| $table->tinyInteger('votes');            | 相当于 TINYINT                                          |
| $table->unsignedBigInteger('votes');     | 相当于 Unsigned BIGINT                                  |
| $table->unsignedDecimal('amount', 8, 2); | 相当于带有精度和基数的 UNSIGNED DECIMAL                 |
| $table->unsignedInteger('votes');        | 相当于 Unsigned INT                                     |
| $table->unsignedMediumInteger('votes');  | 相当于 Unsigned MEDIUMINT                               |
| $table->unsignedSmallInteger('votes');   | 相当于 Unsigned SMALLINT                                |
| $table->unsignedTinyInteger('votes');    | 相当于 Unsigned TINYINT                                 |
| $table->uuid('id');                      | 相当于 UUID                                             |
| $table->year('birth_year');              | 相当于 YEAR                                             |

[查看使用示例](./example/20210304140550_admin.php)

QQ交流群：942503490

by King east
