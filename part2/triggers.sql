CREATE OR REPLACE FUNCTION f_update_hod()
    RETURNS TRIGGER AS
$$
DECLARE 
    new_dep INTEGER;
BEGIN
    IF EXISTS (SELECT faculty_id FROM faculty WHERE faculty_id=NEW.hod_faculty_id) THEN
        SELECT dept_id INTO new_dep FROM faculty WHERE faculty_id=NEW.hod_faculty_id;
        IF (new_dep!=NEW.dept_id) THEN  
            RAISE EXCEPTION 'DEPTARMENT OF FACULTY SHOULD BE SAME AS THE FOR HOD POSITION';
        END IF;
        UPDATE faculty SET post_rank = 10+NEW.dept_id WHERE faculty_id=NEW.hod_faculty_id;
    END IF; 
    RETURN NEW;
END;
$$
LANGUAGE 'plpgsql';

DROP TRIGGER IF EXISTS update_hod ON department;

CREATE TRIGGER update_hod
    AFTER UPDATE 
    ON department
    FOR EACH ROW
    EXECUTE PROCEDURE f_update_hod();

--------------------------UPDATE CCF---------------------------

CREATE OR REPLACE FUNCTION f_update_ccf()
    RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT faculty_id FROM faculty WHERE faculty_id=NEW.faculty_id) THEN
        UPDATE faculty SET post_rank = 100+NEW.ccf_id WHERE faculty_id=NEW.faculty_id;
    END IF; 
    RETURN NEW;
END;
$BODY$
LANGUAGE 'plpgsql';


DROP TRIGGER IF EXISTS update_ccf ON cross_cut_faculty;

CREATE TRIGGER update_ccf
    AFTER UPDATE 
    ON cross_cut_faculty
    FOR EACH ROW
    EXECUTE PROCEDURE f_update_ccf();

-------------------UPDATE DIRECTOR-----------------



-------------------Logging the faculty info----------------------
--this trigger function logs into faculty history any changes that occur
--also if a new HOD is set the older one's post rank is updated back to 0.sele

CREATE OR REPLACE FUNCTION f_faculty_log_update()
    RETURNS TRIGGER AS 
$$
DECLARE
    old_faculty_id VARCHAR(256);
BEGIN

    if OLD.post_rank=0 and NEW.post_rank>0 THEN
        IF EXISTS (SELECT faculty_id FROM faculty WHERE post_rank=NEW.post_rank) THEN
            SELECT faculty_id INTO old_faculty_id FROM faculty WHERE post_rank=NEW.post_rank;
            UPDATE faculty SET post_rank=0 WHERE faculty_id=old_faculty_id;
        END IF;
    
    END IF;
    INSERT INTO faculty_history(faculty_id,old_post,new_post,transaction_time) VALUES (NEW.faculty_id,OLD.post_rank,NEW.post_rank,NOW());
    RETURN NEW;
END;
$$
LANGUAGE 'plpgsql';


DROP TRIGGER IF EXISTS faculty_log_update  ON faculty;

CREATE TRIGGER faculty_log_update
    BEFORE UPDATE
    ON faculty
    FOR EACH ROW
    EXECUTE PROCEDURE f_faculty_log_update();


--------insert faculty

CREATE OR REPLACE FUNCTION f_faculty_log_insert()
    RETURNS TRIGGER AS
$$
DECLARE 
    old_post_rank INT:=-1;
BEGIN
    INSERT INTO faculty_history(faculty_id,old_post,new_post,transaction_time) VALUES (NEW.faculty_id,old_post_rank,NEW.post_rank,NOW());
    RETURN NEW;
END;
$$
LANGUAGE 'plpgsql';

DROP TRIGGER IF EXISTS faculty_log_insert on faculty;

CREATE TRIGGER faculty_log_insert
    BEFORE INSERT
    ON faculty
    FOR EACH ROW
    EXECUTE PROCEDURE f_faculty_log_insert();

--delete

CREATE OR REPLACE FUNCTION f_faculty_log_delete()
    RETURNS TRIGGER AS
$$
DECLARE 
    new_post_rank INT:=-1;
BEGIN
    INSERT INTO faculty_history(faculty_id,old_post,new_post,transaction_time) VALUES (OLD.faculty_id,OLD.post_rank,new_post_rank,NOW());
    RETURN NEW;
END;
$$
LANGUAGE 'plpgsql';

DROP TRIGGER IF EXISTS faculty_log_delete on faculty;

CREATE TRIGGER faculty_log_delete
    BEFORE DELETE
    ON faculty
    FOR EACH ROW
    EXECUTE PROCEDURE f_faculty_log_delete();



--------------------entering the leave history-----------------


CREATE OR REPLACE FUNCTION f_new_leave()
    RETURNS TRIGGER AS
$$
DECLARE
    route_taken RECORD;
    lv_curr_node INT:=1;
    lv_start_dept INT;
    lv_start_post INT :=0;
    lv_end_post INT;
    lv_status VARCHAR(16):='pending';
    lv_approval_faculty VARCHAR(256);
BEGIN
    RAISE INFO 'route %',NEW.leave_route_id;

    SELECT * INTO route_taken FROM leave_routes WHERE route_id=NEW.leave_route_id;
    SELECT  dept_id INTO lv_start_dept FROM faculty WHERE faculty_id=NEW.faculty_id;
    lv_end_post:=route_taken.node1_rankid;
    if lv_end_post=10 THEN
        lv_end_post:=lv_end_post+lv_start_dept;
    END IF;
    SELECT faculty_id INTO lv_approval_faculty FROM faculty WHERE post_rank=lv_end_post;
    INSERT INTO leave_history (leave_id, route_id, curr_node,start_post_id, end_post_id, approval_faculty,status,  transaction_time) VALUES (NEW.leave_id,NEW.leave_route_id,lv_curr_node,lv_start_post,lv_end_post,lv_approval_faculty,lv_status,NOW());
    RETURN NEW;
END;
$$
LANGUAGE 'plpgsql';


DROP TRIGGER IF EXISTS new_leave on leave;

CREATE TRIGGER new_leave
    AFTER INSERT 
    ON leave
    FOR EACH ROW
    EXECUTE PROCEDURE f_new_leave();


-----------------------accept the transaction-------------
-- done in php
-- CREATE OR REPLACE FUNCTION f_leave_accept()
--     RETURNS TRIGGER AS
-- $$
-- DECLARE 
--     route_taken RECORD;

-- BEGIN
--     if NEW.status='accepted' THEN
--         SELECT * INTO route_taken FROM leave_routes WHERE route_id=NEW.route_id;
--         IF route_taken.num_nodes == 
--         INSERT INTO leave_history (leave_id,route_id,curr_node)
--     END IF;
--     RETURN NEW;
-- END;
-- $$
-- LANGUAGE 'plpgsql'


-- DROP TRIGGER IF EXISTS leave_accept on leave_history

-- CREATE TRIGGER leave_accept
--     AFTER UPDATE
--     ON leave_history
--     FOR EACH ROW
--     EXECUTE PROCEDURE f_leave_accept();