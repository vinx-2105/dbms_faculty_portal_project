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
BEGIN
    INSERT INTO leave_history (leave_id, route_id, curr_node,start_faculty_id, end_faculty_id, status, remarks, transaction_time) VALUES (NEW.leave_id,NEW.leave_route_id,1,NEW.faculty_id,/*END FACULTY*/,/*status*/,/*remarks*/,NOW());
    
END;
$$
LANGUAGE 'plpgsql';


DROP TRIGGER IF EXISTS new_leave on leave;

CREATE TRIGGER new_leave
    AFTER INSERT 
    ON leave
    FOR EACH ROW
    EXECUTE PROCEDURE f_new_leave();
