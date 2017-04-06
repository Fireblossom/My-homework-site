
CREATE TABLE "datab_customer" (
    "id" varchar(20) NOT NULL,
    "name" varchar(255) NOT NULL,
    "collage" varchar(255) NOT NULL,
    "password" varchar(128),
    PRIMARY KEY ("id")
);

CREATE INDEX "student_name" ON "datab_customer" USING btree ("name");


CREATE TABLE "datab_admin" (
    "id" serial4 NOT NULL,
    "username" varchar(255) NOT NULL,
    "password" varchar(32),
    PRIMARY KEY ("id")
);

CREATE INDEX "admin_username" ON "datab_admin" USING btree ("username");
INSERT INTO datab_admin (username,password) VALUES ('admin',md5('admin'));


CREATE TABLE "datab_clerk" (
    "id" serial4 NOT NULL,
    "name" varchar(255),
    "collage" varchar(255),
    "password" varchar(32),
    PRIMARY KEY ("id")
);

CREATE INDEX "teacher_name" ON "datab_clerk" USING btree ("name");

CREATE TABLE "datab_subject" (
    "id" serial4,
    "name" varchar(255),
    "collage" varchar(255),
    "teacher" int4,
    PRIMARY KEY ("id"),
    CONSTRAINT "teacher_id" FOREIGN KEY ("teacher") REFERENCES "datab_clerk" ("id") ON DELETE SET NULL ON UPDATE NO ACTION
);

CREATE INDEX "subject_name" ON "datab_subject" USING btree ("name");

CREATE TABLE "datab_score" (
    "student" varchar(20) NOT NULL,
    "subject" int4 NOT NULL,
    "score" int4 DEFAULT NULL,
    PRIMARY KEY ("student", "subject"),
    CONSTRAINT "student_id" FOREIGN KEY ("student") REFERENCES "datab_customer" ("id") ON DELETE CASCADE,
    CONSTRAINT "subject_id" FOREIGN KEY ("subject") REFERENCES "datab_subject" ("id") ON DELETE CASCADE
);




INSERT INTO "datab_customer" VALUES ('1408114148', '朱仕明', '食品部', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO "datab_customer" VALUES ('1408114124', '穆科燃', '玩具部', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO "datab_customer" VALUES ('1408114144', '刘承伟', '杂货部', 'e10adc3949ba59abbe56e057f20f883e');




INSERT INTO "datab_clerk" VALUES (1, '段长续', '食品部', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO "datab_clerk" VALUES (2, '孔祥虎', '玩具部', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO "datab_clerk" VALUES (3, '焦润东', '杂货部', 'e10adc3949ba59abbe56e057f20f883e');



INSERT INTO "datab_subject" VALUES (1, '辣条', '食品部', 1);
INSERT INTO "datab_subject" VALUES (2, '变形金刚', '玩具部', 2);
INSERT INTO "datab_subject" VALUES (3, '方便面', '食品部', 1);
INSERT INTO "datab_subject" VALUES (4, '花露水', '杂货部', 3);
INSERT INTO "datab_subject" VALUES (5, '风油精', '杂货部', 3);
INSERT INTO "datab_subject" VALUES (6, '洗发水', '杂货部', 3);
INSERT INTO "datab_subject" VALUES (7, '沐浴露', '杂货部', 3);
INSERT INTO "datab_subject" VALUES (8, '锅巴', '食品部', 1);
INSERT INTO "datab_subject" VALUES (9, '果冻', '食品部', 1);
INSERT INTO "datab_subject" VALUES (10, '巧克力', '食品部', 1);
INSERT INTO "datab_subject" VALUES (11, '面包', '食品部', 1);
INSERT INTO "datab_subject" VALUES (12, '火腿肠', '食品部', 1);
INSERT INTO "datab_subject" VALUES (13, '酸奶', '食品部', 1);
INSERT INTO "datab_subject" VALUES (14, '玩具枪', '玩具部', 2);
INSERT INTO "datab_subject" VALUES (15, '玩具飞机', '玩具部', 2);
INSERT INTO "datab_subject" VALUES (16, '玩具坦克', '玩具部', 2);
INSERT INTO "datab_subject" VALUES (17, '宇宙飞船', '玩具部', 2);

