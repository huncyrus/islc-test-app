create table `islc_users` (
    `id` int(100) not null auto_increment,
    `user_state` smallInt(5) not null default '0',
    `email_address` varchar(100) not null default '',
    `user_name` varchar(50) not null default '',
    `default_lang` varchar(2) not null default 'EN',
    `create_date` datetime not null default '0000-00-00 00:00:00',
    `last_login` datetime not null default '0000-00-0 00:00:00',
    primary key(id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


create table `islc_user_info` (
    `id` int(100) not null auto_increment,
    `user_id` int(100) not null default '0',
    `language` varchar(2) not null default 'EN',
    `user_description` text not null,
    `born_date` date not null default '0000-0-00',
    `born_city` varchar(100) not null default '',
    primary key(id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `islc_user_info` ADD INDEX(`user_id`);


create table `islc_taskdocs` (
    `id` int(100) not null auto_increment,
    `title` varchar(200) not null default '',
    `descitpion` text not null,
    `create_date` datetime not null default '0000-00-00 00:00:00',
    `lang` varchar(2) not null default 'EN',
    `created_by` int(100) not null default '0' comment 'users.id',
    `downloads` int(10) not null default '0',
    primary key(id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `islc_taskdocs` ADD INDEX(`created_by`);


create table `islc_task_downloads` (
    `id` int(100) not null auto_increment,
    `taskdoc_id` int(100) not null default '0',
    `user_id` int(100) not null default '0',
    `create_date` datetime not null default '0000-00-00 00:00:00',
    primary key(id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

ALTER TABLE `islc_task_downloads` ADD INDEX(`taskdoc_id`);
ALTER TABLE `islc_task_downloads` ADD INDEX(`user_id`);


-- test datas
INSERT INTO islc_users (id, user_state, email_address, user_name, default_lang, create_date, last_login) VALUES (1, 1, 'a@a.com', 'aaa', 'EN', '2016-02-01 16:09:08', '2016-02-01 16:09:12');
INSERT INTO islc_users (id, user_state, email_address, user_name, default_lang, create_date, last_login) VALUES (2, 1, 'b@b.com', 'bbb', 'DE', '2015-02-06 16:08:38', '2015-08-28 16:10:12');
INSERT INTO islc_users (id, user_state, email_address, user_name, default_lang, create_date, last_login) VALUES (3, 2, 'c@c.com', 'ccc', 'FR', '2014-06-10 20:10:46', '2016-01-12 16:11:05');

INSERT INTO islc_taskdocs (id, title, descitpion, create_date, lang, created_by, downloads) VALUES (1, 'title_1', 'doc_desc_1', '2016-02-01 16:13:56', 'EN', 1, 23);
INSERT INTO islc_taskdocs (id, title, descitpion, create_date, lang, created_by, downloads) VALUES (2, 'title_2', 'doc_desc_2', '2014-05-05 16:14:39', 'FR', 1, 10);
INSERT INTO islc_taskdocs (id, title, descitpion, create_date, lang, created_by, downloads) VALUES (3, 'title_3', 'doc_desc_3', '2014-05-08 16:15:12', 'NL', 1, 5);
INSERT INTO islc_taskdocs (id, title, descitpion, create_date, lang, created_by, downloads) VALUES (4, 'title_4', 'doc_desc_4', '2014-05-14 16:15:51', 'EN', 2, 7);
INSERT INTO islc_taskdocs (id, title, descitpion, create_date, lang, created_by, downloads) VALUES (5, 'title_5', 'doc_desc_5', '2014-05-01 16:16:29', 'EN', 2, 5);
INSERT INTO islc_taskdocs (id, title, descitpion, create_date, lang, created_by, downloads) VALUES (6, 'title_6', 'doc_desc_6', '2015-02-01 16:16:58', 'DE', 2, 1);
INSERT INTO islc_taskdocs (id, title, descitpion, create_date, lang, created_by, downloads) VALUES (7, 'title_7', 'doc_desc_7', '2015-02-07 16:17:21', 'DE', 2, 3);
INSERT INTO islc_taskdocs (id, title, descitpion, create_date, lang, created_by, downloads) VALUES (8, 'title_8', 'doc_desc_8', '2016-02-01 16:17:50', 'DE', 3, 10);
INSERT INTO islc_taskdocs (id, title, descitpion, create_date, lang, created_by, downloads) VALUES (9, 'title_9', 'doc_desc_9', '2013-09-01 16:18:17', 'FR', 3, 12);

INSERT INTO islc_user_info (id, user_id, language, user_description, born_date, born_city) VALUES (1, 1, 'EN', 'desc1', '2001-02-09', 'city_1');
INSERT INTO islc_user_info (id, user_id, language, user_description, born_date, born_city) VALUES (2, 2, 'DE', 'desc_2', '1988-10-08', 'city_2');
INSERT INTO islc_user_info (id, user_id, language, user_description, born_date, born_city) VALUES (3, 3, 'FR', 'desc_3', '1994-07-04', 'city_3');


insert into
  islc_task_downloads
values
  (1, 1, 1, '2016-02-01 10:01:10'),
  (2, 1, 1, '2016-02-01 10:00:00'),
  (3, 1, 2, '2016-02-01 10:00:00'),
  (4, 1, 2, '2016-02-01 16:17:17'),
  (5, 1, 3, '2016-02-01 11:11:11'),
  (6, 1, 2, '2016-02-01 14:00:00'),
  (7, 1, 3, '2016-02-01 04:00:00'),
  (8, 1, 1, '2016-02-01 05:00:00'),
  (9, 1, 1, '2016-02-01 11:55:00'),
  (10, 1, 3, '2016-02-01 10:11:55'),
  (11, 1, 2, '2016-02-01 16:10:00'),
  (12, 1, 3, '2016-02-01 16:00:00'),
  (13, 1, 2, '2016-02-01 16:00:00'),
  (14, 1, 2, '2016-02-01 15:00:00'),
  (15, 1, 3, '2016-02-01 14:00:00'),
  (16, 1, 2, '2016-02-01 13:00:00'),
  (17, 1, 3, '2016-02-01 12:00:00'),
  (18, 1, 2, '2016-02-01 10:08:00'),
  (19, 1, 3, '2016-02-01 10:07:00'),
  (20, 1, 2, '2016-02-01 10:06:00'),
  (21, 1, 1, '2016-02-01 10:05:00'),
  (22, 1, 2, '2016-02-01 10:04:00');


insert into
  islc_task_downloads
  (taskdoc_id, user_id, create_date)
values
  (2, 1, '2014-05-05 05:00:00'),
  (2, 1, '2014-05-05 05:00:00'),
  (2, 2, '2014-05-08 05:00:00'),
  (2, 3, '2014-08-07 05:00:00'),
  (2, 3, '2014-08-01 05:00:00'),
  (2, 2, '2014-06-30 05:00:00'),
  (2, 2, '2014-11-05 05:00:00'),
  (2, 1, '2015-01-05 05:00:00'),
  (2, 1, '2014-08-05 05:00:00'),
  (2, 2, '2014-09-05 05:00:00');


insert into
  islc_task_downloads
  (taskdoc_id, user_id, create_date)
values
  (3, 1, '2014-05-08 01:00:00'),
  (3, 2, '2014-05-08 04:55:00'),
  (3, 3, '2014-05-08 14:00:00'),
  (3, 3, '2014-06-08 21:00:00'),
  (3, 1, '2014-05-08 11:00:00');


insert into
  islc_task_downloads
  (taskdoc_id, user_id, create_date)
values
  (4, 1, '2014-05-14 05:00:00'),
  (4, 2, '2014-05-14 18:00:00'),
  (4, 2, '2015-02-22 20:00:00'),
  (4, 2, '2015-07-01 09:00:00'),
  (4, 3, '2014-05-14 06:00:00'),
  (4, 3, '2015-08-11 12:00:00'),
  (4, 3, '2015-08-18 11:00:00');


insert into
  islc_task_downloads
  (taskdoc_id, user_id, create_date)
values
  (5, 1, '2014-05-01 12:00:00'),
  (5, 1, '2014-05-022 01:00:00'),
  (5, 3, '2014-06-03 23:55:00'),
  (5, 3, '2014-06-19 05:00:00'),
  (5, 3, '2014-09-09 15:12:10');


insert into
  islc_task_downloads
  (taskdoc_id, user_id, create_date)
values
  (6, 2, '2015-02-02 05:00:00');


insert into
  islc_task_downloads
  (taskdoc_id, user_id, create_date)
values
  (7, 1, '2015-02-07 23:00:00'),
  (7, 2, '2015-04-07 23:00:00'),
  (7, 3, '2015-05-07 23:00:00');


insert into
  islc_task_downloads
  (taskdoc_id, user_id, create_date)
values
  (8, 1, '2016-02-01 17:00:00'),
  (8, 1, '2016-02-01 18:30:55'),
  (8, 1, '2016-02-01 17:22:09'),
  (8, 2, '2016-02-01 19:03:00'),
  (8, 2, '2016-02-01 17:55:00'),
  (8, 2, '2016-02-01 17:00:32'),
  (8, 2, '2016-02-01 17:21:00'),
  (8, 2, '2016-02-01 17:22:22'),
  (8, 2, '2016-02-01 17:07:00'),
  (8, 3, '2016-02-01 18:00:00');


insert into
  islc_task_downloads
  (taskdoc_id, user_id, create_date)
values
  (9, 1, '2013-09-03 21:43:51'),
  (9, 3, '2013-12-30 21:43:51'),
  (9, 3, '2013-09-03 21:43:51'),
  (9, 2, '2013-11-03 21:43:51'),
  (9, 2, '2015-07-27 21:43:51'),
  (9, 1, '2014-12-03 21:43:51'),
  (9, 1, '2015-04-03 21:43:51'),
  (9, 2, '2013-09-03 21:43:51'),
  (9, 2, '2014-09-03 21:43:51'),
  (9, 2, '2014-08-03 21:43:51'),
  (9, 1, '2016-01-09 21:43:51'),
  (9, 2, '2016-01-03 21:43:51');
