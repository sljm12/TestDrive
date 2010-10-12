create table post (id Integer Not null primary key autoincrement,
		title varchar(255) not null,
		url varchar(255) not null,
		remarks varchar(500) not null,
		clicks Integer,
		dateUpdated date default CURRENT_TIMESTAMP,
		userid varchar(300),
		foreign key (userid) references userdetails(openidurl)
);

create table category(id Integer Not Null primary key autoincrement,
name varchar(255) not null);

create table post_category(postid Integer,categoryid Integer,
foreign key (postid) references post(id),
primary key (postid,categoryid),
foreign key (categoryid) references category(id));

create table userdetails(userid Integer primary key autoincrement, username varchar(50),openidurl varchar(300), email varchar(255));

insert into category(name) values('photography');
insert into category(name) values('spree');
insert into category(name) values('fashion');
insert into category(name) values('gadgets');
insert into category(name) values('jewellery');
