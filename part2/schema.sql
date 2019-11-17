CREATE TABLE faculty(
	faculty_id VARCHAR(256) PRIMARY KEY,
	password VARCHAR(256) NOT NULL,
	name VARCHAR(256) NOT NULL,
	leave_count INT,
	dept_id INT,
	leave_route_id INT,
	post_rank INT DEFAULT 0,
	post_start_date Date DEFAULT NULL,
	post_end_date Date DEFAULT NULL
);

CREATE TABLE faculty_history(
	transaction_id SERIAL PRIMARY KEY,
	faculty_id VARCHAR(256),
	transaction_time TIMESTAMP,
	old_post INT,
	new_post INT
);

CREATE TABLE department(
	dept_id SERIAL PRIMARY KEY,
	name VARCHAR(256) UNIQUE,
	hod_faculty_id VARCHAR(256)
);


CREATE TABLE post_rank(
	rank_id INT PRIMARY KEY,
	rank_title VARCHAR(256) UNIQUE NOT NULL
);

INSERT INTO post_rank VALUES (1,'Director');
INSERT INTO post_rank VALUES (0,'Faculty');
INSERT INTO post_rank VALUES (10,'HOD');

/*
post ranks :
rank 0 : academic faculty
rank 1 : director
rank 10 : HOD
rank 100+i: ccf, i=ccf_id 
*/

CREATE TABLE cross_cut_faculty(
	ccf_id SERIAL PRIMARY KEY,
	title VARCHAR(256) UNIQUE,
	faculty_id VARCHAR(256)
);


CREATE TABLE leave_routes(
	route_id SERIAL PRIMARY KEY,
	num_nodes INT,
	node1_rankid INT,
	node2_rankid INT,
	node3_rankid INT,
	node4_rankid INT,
	node5_rankid INT	
);

CREATE TABLE leave(
	leave_id SERIAL PRIMARY KEY,
	faculty_id VARCHAR(256) NOT NULL,
	leave_purpose text ,
	start_date DATE NOT NULL,
	num_days INT NOT NULL,
	leave_route_id INT, 
	status INT DEFAULT 0
);
/* removed borrowed column*/


/* status
0: pending
1: accepted
2: rejected
*/
DROP TABLE IF EXISTS leave_history;

CREATE TABLE leave_history(
	transaction_id SERIAL PRIMARY KEY,
	leave_id INT NOT NULL,
	route_id INT NOT NULL,
	curr_node INT,
	start_post_id VARCHAR(256) ,
	end_post_id VARCHAR(256),
	status VARCHAR(16),
	remarks TEXT,
	transactcreion_time TIMESTAMP
);

/*
status
accepted
rejected
review
pending
*/


CREATE TABLE defaults(
	parameter text NOT NULL,
	default_value INT NOT NULL
);

INSERT INTO defaults values ('leave_count', 5);
INSERT INTO defaults values ('route_id',1);


-- maximum number of steps for the leave application is fixed to 5

----------------------------------------------------------------------

--foreign key constraints for department
ALTER TABLE faculty
ADD FOREIGN KEY (dept_id) REFERENCES department(dept_id);


--foreign key constraints for routes
ALTER TABLE faculty
ADD FOREIGN KEY (leave_route_id) REFERENCES leave_routes(route_id);


--foreign key constraint for ranks
ALTER TABLE faculty
ADD FOREIGN KEY (post_rank) REFERENCES post_rank(rank_id);

--foregin key constraint for HOD
ALTER TABLE department
ADD FOREIGN KEY (hod_faculty_id) REFERENCES faculty(faculty_id);


ALTER TABLE cross_cut_faculty
ADD FOREIGN KEY (faculty_id) REFERENCES faculty(faculty_id);
-------------------
--leave and leave history constraint

ALTER TABLE leave
ADD FOREIGN KEY (faculty_id) REFERENCES faculty(faculty_id);

ALTER TABLE leave
ADD FOREIGN KEY (leave_route_id) REFERENCES leave_routes(route_id);

ALTER TABLE leave_history
ADD FOREIGN KEY (leave_id) REFERENCES leave(leave_id) ;
ALTER TABLE leave_history
ADD FOREIGN KEY (route_id) REFERENCES leave_routes(route_id) ;




/*

insert into department(dept_id,name,hod_faculty_id) values (1,'cs', NULL);
insert into post_rank(rank_id, rank_title) values (1,'academic faculty');
insert into post_rank values(10,'hod');
insert into faculty(faculty_id,name,leave_count, dept_id,post_rank,route_id) values(1234,'mehakjot', 5,1,1,123);
insert into faculty(faculty_id,name, leave_count,dept_id, post_rank) values(1235,'vineet', 5,1,10);
insert into leave_routes(route_id, num_nodes,node1_rankid) values(123,1,10);

insert into leave values(123411,1234,123,'2019-11-14',2,0,3);

insert into 
*/

--create trigger to input to faculty history.
