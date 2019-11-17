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
        IF EXISTS  (SELECT faculty_id FROM faculty WHERE faculty_id= OLD.hod_faculty_id) THEN
            UPDATE faculty SET post_rank = 0 WHERE faculty_id=OLD.hod_faculty_id;
        END IF;
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
        if EXISTS  (SELECT faculty_id FROM faculty WHERE faculty_id= OLD.faculty_id) THEN
            UPDATE faculty SET post_rank = 0 WHERE faculty_id=OLD.faculty_id;
        END IF;
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



--------------------entering the leave history-----------------


CREATE OR REPLACE FUNCTION f_new_leave()
    RETURNS TRIGGER AS
$$
DECLARE
    route_taken RECORD;
    lv_curr_node INT:=1;
    lv_start_dept INT;
    lv_end_faculty VARCHAR(256);
    post_rank_faculty INT;
    lv_status VARCHAR(16):='pending';
BEGIN
    RAISE INFO 'route %',NEW.leave_route_id;

    SELECT * INTO route_taken FROM leave_routes WHERE route_id=NEW.leave_route_id;
    SELECT  dept_id INTO lv_start_dept FROM faculty WHERE faculty_id=NEW.faculty_id;
    post_rank_faculty:=route_taken.node1_rankid;
    if post_rank_faculty=10 THEN
        post_rank_faculty:=post_rank_faculty+lv_start_dept;
    END IF;
    SELECT faculty_id into lv_end_faculty FROM faculty WHERE post_rank=post_rank_faculty;
    INSERT INTO leave_history (leave_id, route_id, curr_node,start_faculty_id, end_faculty_id,post_id, status,  transaction_time) VALUES (NEW.leave_id,NEW.leave_route_id,lv_curr_node,NEW.faculty_id,lv_end_faculty,post_rank_faculty,lv_status,NOW());
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
