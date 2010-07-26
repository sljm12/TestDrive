create table post (id Integer Not null primary key auto_increment,
		title varchar(255) not null,
		url varchar(255) not null,
		remarks varchar(500) not null,
		clicks Integer,
		dateAdded datetime
);
