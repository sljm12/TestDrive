create table userdetails(userid Integer primary key auto_increment, username varchar(50),openidurl varchar(300), email varchar(255),updatePref boolean default true);

Alter table userdetails add column(blogshopowner boolean default false);
Alter table userdetails add column(receiveEmail boolean default true);

create index idx_userdetails_openidurl on userdetails(openidurl);

create table post (id Integer Not null primary key auto_increment,
		title varchar(255) not null,
		url varchar(255) not null,
		remarks varchar(500) not null,
		clicks Integer,
		dateUpdated timestamp default now(),
		userid varchar(300),
		foreign key (userid) references userdetails(openidurl)
);

alter table post add column (file_hash varchar(64) default null);
alter table post add column (blogid integer, foreign key (blogid) references blogshop(id));

create table category(id Integer Not Null primary key auto_increment,
name varchar(255) not null);

create table post_category(postid Integer,categoryid Integer,
foreign key (postid) references post(id),
primary key (postid,categoryid),
foreign key (categoryid) references category(id));


create table preferences(pref_id Integer primary key auto_increment, openidurl varchar(300), interested_categories varchar(300), email_newsletter boolean
, foreign key(openidurl) references userdetails(openidurl));

create table blogshop(id Integer primary key auto_increment, shopname varchar(255), url varchar(100), remarks varchar(300), openidurl varchar(300) not null, rssUrl varchar(500), foreign key (openidurl) references userdetails(openidurl));

alter table blogshop add column(last_update datetime);

create table blogshop_categories(blogshopid Integer,categoryid Integer,
foreign key (blogshopid) references blogshop(id),
primary key (blogshopid,categoryid),
foreign key (categoryid) references category(id));

insert into category(name) values('photography');
insert into category(name) values('spree');
insert into category(name) values('fashion');
insert into category(name) values('gadgets');
insert into category(name) values('jewellery');

