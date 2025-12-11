create table if not exists `issues`
(
    `id` bigint unsigned not null unique primary key auto_increment  ,
    `full_name` varchar(128) not null ,
    `email` varchar(128) not null ,
    `phone` varchar(20) not null  ,
    `body` longtext not null  ,
    `status` enum('pending','publish','answered') default 'pending' ,
    `created_at` datetime default current_timestamp ,
    `updated_at` datetime default null
);
create table if not exists `answers`(
    `id` bigint unsigned unique not null primary key auto_increment ,
    `issue_id` bigint unsigned not null  ,
    `body` longtext not null ,
    `created_at` datetime default current_timestamp ,
    `updated_at` datetime default null ,
    foreign key (`issue_id`) references `issues`(`id`) on delete cascade on update cascade
);
use `seven_learn_ticket`;
