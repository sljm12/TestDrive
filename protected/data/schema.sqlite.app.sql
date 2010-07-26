create table post (id Integer Not null primary key autoincrement,
		title varchar(255) not null,
		url varchar(255) not null,
		remarks varchar(500) not null,
		clicks Integer,
		dateUpdated date default CURRENT_TIMESTAMP
);