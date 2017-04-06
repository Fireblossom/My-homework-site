---
title: 2017-1-2未命名文件 
tags: 新建,模板,小书匠
grammar_cjkRuby: true
---
# 摘要
当今社会正处于信息时代，信息技术已渗透到社会生活的各个领域，
在高校中，学生的成绩信息管理是属于一种既重要又比较复杂的系统，利用信息技术对高校学生成绩系统进行管理是十分重要的。作为计算机应用的一部分，使用计算机对学生档案进行管理，有着手工管理所无法比拟的优点，如：检索迅速、查找方便、可靠性高、存储量大、保密性好、寿命长、成本低等。这些优点能够极大地提高学生档案管理的效率，也是学校向科学化、正规化管理发展的必要条件，更是各个高等院校与世界接轨的重要条件。
本系统使用基于加州大学伯克利分校计算机系开发的一款优秀数据库系统PostgreSQL来帮助学校，教师，与学生管理具体的成绩信息。

关键字:PostgreSQL，学生成绩管理系统，数据库

# Abstract



## 第一章 设计内容和要求

当今社会正处于信息时代，信息技术已渗透到社会生活的各个领域，
在高校中，学生的成绩信息管理是属于一种既重要又比较复杂的系统，利用信息技术对高校学生成绩系统进行管理是十分重要的。作为计算机应用的一部分，使用计算机对学生档案进行管理，有着手工管理所无法比拟的优点，如：检索迅速、查找方便、可靠性高、存储量大、保密性好、寿命长、成本低等。这些优点能够极大地提高学生档案管理的效率，也是学校向科学化、正规化管理发展的必要条件，更是各个高等院校与世界接轨的重要条件。
本系统使用基于加州大学伯克利分校计算机系开发的一款优秀数据库系统PostgreSQL来帮助学校，教师，与学生管理具体的成绩信息。
本系统实现了以下功能：不同用户分别管理与登陆，学生选课，学生查看成绩，教师评分，教师获得选课结果，对学生信息、教师信息与课程信息进行管理。
设计思想：(1)、能够根据不同的用户以不同的身份登陆，根据不同的身份具有不同的权限和身份。(2)、尽量最通用的软件平台就可以访问和管理此系统，本系统支持使用任意一种现代浏览器登录使用(3)、针对服务器方面，采用现在最新容器技术实现快速的部署，使高校可以快速的部署此系统，并可以快速投入使用。(4）、系统应具备数据库维护功能，及时根据用户需求进行数据的添加、删除、修改、备份等操作。



## 第二章 数据库运行开发环境

### 2.1 开发环境
数据库系统：PostgreSQL
HTTP服务器：Nginx
CGI脚本程序：PHP-FPM
操作系统：Linux
容器系统：Docker
容器编排：docker-compose
### 2.2 部署环境
操作系统：Linux
依赖环境：Docker、docker-compose


## 第三章 需求分析
### 3.1 系统目标与要求

数据库数据要完整、同步、准确地反映学生管理过程中所需要的各方面信息。

### 3.2 系统功能模块

#### 3.21 用户登录模块
针对不同用户身份进行登录，系统用户的身份包括：学生，教师与管理员。
#### 3.22 管理员管理模块
针对学生，教师，与管理员的信息进行增加，修改，删除与查询。
#### 3.23 学生选课模块
学生能够根据管理员在系统中插入的教师信息与课程信息进行选课与评分。
#### 3.24 教师评分模块
教师能根据学生所选课来给予学生评分。

## 第四章 系统设计
### 4.1 数据库设计
根据上述需求，将数据库分为5个表，分别为：
* 管理员表 htu_admin
* 学生表 htu_student
* 教师表 htu_teacher
* 课程表 htu_subject
* 分数表 htu_score

为了安全起见，所有可以登录的用户的密码均采用MD5加密后存储。
#### 4.1.1 管理员表 `htu_admin`
管理员表用于存储管理员信息。表结构如下：
| 字段名 | 名称 | 字段类型 | 说明 | 主键 | 外键 | 索引 |
| --- | --- | --- | --- | --- | --- | --- |
| id | 教师编号 | varchar(255) | | 是 |
| username | 账号 | varchar(255) | NOT NULL | | | B-tree |
| password | 密码 | text | NOT NULL | | | B-tree |
```sql
CREATE TABLE "htu_admin" (
    "id" serial4 NOT NULL,
    "username" varchar(255) NOT NULL,
    "password" varchar(32),
    PRIMARY KEY ("id")
);

CREATE INDEX "admin_username" ON "htu_admin" USING btree ("username");
INSERT INTO htu_admin (username,password) VALUES ('admin',md5('admin'));//默认账户
```
#### 4.1.2 学生表 `htu_student`
管理员表用于存储管理员信息。表结构如下：
| 字段名 | 名称 | 字段类型 | 说明 | 主键 | 外键 |索引|
| --- | --- | --- | --- | --- | --- | --- |
| id | 学号 | varchar(20) |  | 是|
| name | 姓名 | varchar(255) | NOT NULL | | | B-tree |
| garde | 年级 | int |
| class | 班级 | text |
| sex | 性别 | int |
| phone | 电话 | varchar(255) |
| password | 密码 | text | NOT NULL |
```sql
CREATE TABLE "htu_student" (
    "id" varchar(20) NOT NULL,
    "name" varchar(255) NOT NULL,
    "grade" int4 NOT NULL,
    "major" text NOT NULL,
    "sex" int2 NOT NULL,
    "collage" varchar(255) NOT NULL,
    "password" varchar(128),
    PRIMARY KEY ("id")
);

CREATE INDEX "student_name" ON "htu_student" USING btree ("name");
```

#### 4.1.3 教师表 `htu_teacher`
管理员表用于存储教师信息。表结构如下：
| 字段名 | 名称 | 字段类型 | 说明 | 主键 | 外键 | 索引 |
| --- | --- | --- | --- | --- | --- | --- |
| id | 教师编号 | varchar(255) | | 是 |
| name | 教师姓名 | varchar(255) | NOT NULL | | | B-tree |
| collage | 所属学院 |  varchar(255) |
| password | 密码 | text | NOT NULL |
```sql
CREATE TABLE "htu_teacher" (
    "id" serial4 NOT NULL,
    "name" varchar(255),
    "collage" varchar(255),
    "password" varchar(32),
    PRIMARY KEY ("id")
);

CREATE INDEX "teacher_name" ON "htu_teacher" USING btree ("name");
```
#### 4.1.4 课程表 `htu_subject`
管理员表用于存储教师信息。表结构如下：
| 字段名 | 名称 | 字段类型 | 说明 | 主键 | 外键 | 索引 |
| --- | --- | --- | --- | --- | --- | --- |
| id | 科目id| int | 自增 | 是 |
| name | 科目名称| varchar(255) |NOT NULL|||B-tree|
|teacher|授课教师|varchar(255)|||htu_teacher.id|
```sql
CREATE TABLE "htu_subject" (
    "id" serial4,
    "name" varchar(255),
    "collage" varchar(255),
    "teacher" int4,
    PRIMARY KEY ("id"),
    CONSTRAINT "teacher_id" FOREIGN KEY ("teacher") REFERENCES "htu_teacher" ("id") ON DELETE SET NULL ON UPDATE NO ACTION
);

CREATE INDEX "subject_name" ON "htu_subject" USING btree ("name");
```
#### 4.1.5 分数表 `htu_score`
管理员表用于存储教师信息。表结构如下：
| 字段名 | 名称 | 字段类型 | 说明 | 主键 | 外键 | 索引 |
| --- | --- | --- | --- | --- | --- | --- |
| id | 科目id| int | 自增 | 是 |
| subject | 科目id | int | NOT NULL | | htu_subject.id | B-tree |
| student | 学生id | varchar(20) | NOT NULL | | htu_student.id | B-tree |
| score | 分数 | int |
```sql
CREATE TABLE "htu_score" (
    "student" varchar(20) NOT NULL,
    "subject" int4 NOT NULL,
    "score" int4 DEFAULT NULL,
    PRIMARY KEY ("student", "subject"),
    CONSTRAINT "student_id" FOREIGN KEY ("student") REFERENCES "htu_student" ("id") ON DELETE CASCADE,
    CONSTRAINT "subject_id" FOREIGN KEY ("subject") REFERENCES "htu_subject" ("id") ON DELETE CASCADE
);

CREATE INDEX "student_id" ON "htu_score" USING btree ("student");
CREATE INDEX "subject_id" ON "htu_score" USING btree ("subject");
```
### 4.2 系统功能设计
总体系统功能设计如下图：

#### 4.2.1 登录模块
用于验证用户信息是否异常，并重定向浏览器到其他模块。
用户检测登陆的语句如下：
```sql
select count(*) from htu_admin where username=:id and password=md5(:password);
select count(*) from htu_student where id=:id and password=md5(:password);
select count(*) from htu_teacher where id=:id and password=md5(:password);
```
#### 4.2.2 管理员模块
##### 4.2.2.1 教师管理模块
用于增加，删除，修改和查询教师的信息。
用于查询的语句如下：
```sql
select * from htu_teacher order by id asc;
```
##### 4.2.2.2 学生管理模块
用于增加，删除，修改和查询学生的信息。
用于查询的语句如下：
```sql
select * from htu_student order by id asc;
```
##### 4.2.2.3 课程管理模块
用于增加，删除，修改和查询学生的信息。
用于查询的语句如下：
```sql
select htu_teacher.name as teacher_name,htu_subject.id as id,htu_subject.name as name,htu_subject.collage as collage from htu_teacher cinner join htu_subject on htu_teacher.id=htu_subject.teacher
```
#### 4.2.3 学生模块
##### 4.2.3.1 学生选课模块
用于学生选课与退选
查询未选：
```sql
select p.id,p.name,p.collage,htu_teacher.name as teacher from (select htu_subject.* from htu_subject inner join htu_score on htu_subject.id=htu_score.subject where htu_score.student=:id) as p inner join htu_teacher on p.teacher=htu_teacher.id;
``` 
查询已选：
```sql
select p.id,p.name,p.collage,htu_teacher.name as teacher from ( select * from htu_subject left join (select subject,score from htu_score where student=:id) as has on has.subject=htu_subject.id where has.subject isnull ) as p inner join htu_teacher on p.teacher=htu_teacher.id;
```
##### 4.2.3.2 学生查询成绩模块
查询学生的每门成绩：
```sql
select id,name,collage,teacher,score from htu_subject inner join htu_score on htu_score.subject=htu_subject.id where student=:id;
```
#### 4.2.4 教师模块
##### 4.2.4.1 查询选课结果
查询教师负责的课程信息：
```sql
select id,name,collage from htu_subject where teacher=:teacher;
```
查询每门课的选课信息：
```sql
select p.id,p.name,p.collage,htu_teacher.name as teacher from ( select * from htu_subject left join (select subject,score from htu_score where student=:id) as has on has.subject=htu_subject.id where has.subject isnull ) as p inner join htu_teacher on p.teacher=htu_teacher.id;
```
##### 4.2.4.2 评分
给予每个学生具体分数：
```sql
update htu_score set score=:score where student=:student and subject=:subject
```
## 第四章 系统的使用和管理
### 系统运行需求
* Linux 内核版本 > 4.8
* docker 版本>1.9
* docker-compose
### 运行系统
```bash
cd cs-database
docker-compose up -d
```
### 导入数据
```bash
docker exec -ti csdatabase_db_1 pgsql -U postgres -W -d htu -f ../sql/init.sql
```
### 退出系统
```bash
docker-compose down
```
