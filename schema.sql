drop table users cascade constraints;
drop table usersession;

create table users(
 userid varchar2(12) primary key,
 password varchar2(12),
 utype varchar2(16)
);

create table usersession (
  sessionid varchar2(32) primary key,
  userid varchar2(8),
  sessiondate date,
  foreign key (userid) references users
);

insert into users values('Jose','ernesto','Student');
insert into users values('Austin','pass8','Administrator');
insert into users values('Tirsit','username','Both');

commit;

