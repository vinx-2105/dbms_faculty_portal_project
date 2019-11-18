DROP TABLE IF EXISTS faculty  ;

CREATE TABLE faculty(
	faculty_id VARCHAR(256) PRIMARY KEY,
	password VARCHAR(256) NOT NULL,
	name VARCHAR(256) NOT NULL,
	leave_count INT,
	dept_id INT,
	post_rank INT DEFAULT 0,
	post_start_date Date DEFAULT NULL,
	post_end_date Date DEFAULT NULL
);

DROP TABLE IF EXISTS faculty_history  ;


CREATE TABLE faculty_history(
	transaction_id SERIAL PRIMARY KEY,
	faculty_id VARCHAR(256),
	transaction_time TIMESTAMP,
	old_post INT,
	new_post INT
);

DROP TABLE IF EXISTS department  ;


CREATE TABLE department(
	dept_id SERIAL PRIMARY KEY,
	name VARCHAR(256) UNIQUE,
	hod_faculty_id VARCHAR(256)
);

DROP TABLE IF EXISTS post_rank  ;


CREATE TABLE post_rank(
	rank_id INT PRIMARY KEY,
	rank_title VARCHAR(256) UNIQUE NOT NULL,
	leave_route_id INT
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
DROP TABLE IF EXISTS cross_cut_faculty  ;

CREATE TABLE cross_cut_faculty(
	ccf_id SERIAL PRIMARY KEY,
	title VARCHAR(256) UNIQUE,
	faculty_id VARCHAR(256)
);

DROP TABLE IF EXISTS leave_routes  ;

CREATE TABLE leave_routes(
	route_id SERIAL PRIMARY KEY,
	num_nodes INT,
	node1_rankid INT,
	node2_rankid INT,
	node3_rankid INT,
	node4_rankid INT,
	node5_rankid INT	
);

DROP TABLE IF EXISTS leave  ;
CREATE TABLE leave(
	leave_id SERIAL PRIMARY KEY,
	faculty_id VARCHAR(256) NOT NULL,
	leave_purpose text ,
	start_date DATE NOT NULL,
	num_days INT NOT NULL,
	leave_route_id INT, 
	status varchar(16) DEFAULT 'pending'
);
/* removed borrowed column*/


/* status
0: pending
1: accepted
2: rejected
*/
DROP TABLE IF EXISTS leave_history  ;

CREATE TABLE leave_history(
	transaction_id SERIAL PRIMARY KEY,
	leave_id INT NOT NULL,
	route_id INT NOT NULL,
	curr_node INT,
	start_post_id INT ,
	end_post_id INT,
	status VARCHAR(16),
	remarks TEXT,
	transaction_time TIMESTAMP
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


-----------------new changes to route id
-- ALTER TABLE faculty DROP COLUMN leave_route_id;
-- ALTER TABLE post_rank ADD leave_route_id INT;
-- ALTER TABLE post_rank ADD FOREIGN KEY (leave_route_id)  REFERENCES leave_routes(route_id);



insert into department(name) values ('CSE');
insert into leave_routes(num_nodes,node1_rankid,node2_rankid) VALUES (2,10,1);


