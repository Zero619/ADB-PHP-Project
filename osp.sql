
DROP DATABASE IF EXISTS ospedale;

CREATE DATABASE ospedale;
 
USE ospedale;
 
CREATE TABLE doctor (
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    gender VARCHAR(255),
    phone VARCHAR(32),
    address VARCHAR(255),
    specialization VARCHAR(255),
    PRIMARY KEY (id)
);

CREATE TABLE nurse (
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(32),
    address VARCHAR(255),
    specialization VARCHAR(255),
    PRIMARY KEY (id)
);

CREATE TABLE medicine (
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    price INT,
    PRIMARY KEY (id)
);

CREATE TABLE room (
    room_no INT NOT NULL,
    room_type VARCHAR(255),
    price INT,
    beds_no INT,
    nurse_id INT,
    PRIMARY KEY (room_no),
    FOREIGN KEY (nurse_id)
        REFERENCES nurse (id)
);
 
CREATE TABLE patient (
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(32),
    age INT,
    gender VARCHAR(255),
    address VARCHAR(255),
    r_no INT,
    PRIMARY KEY (id),
    FOREIGN KEY (r_no)
        REFERENCES room (room_no)
);

CREATE TABLE appointment (
    id INT AUTO_INCREMENT NOT NULL,
    description VARCHAR(255) NOT NULL,
    date DATE,
    p_id INT,
    d_id INT,
    PRIMARY KEY (id),
    FOREIGN KEY (p_id)
        REFERENCES patient (id),
    FOREIGN KEY (d_id)
        REFERENCES doctor (id)
);

CREATE TABLE prescription (
    id INT AUTO_INCREMENT NOT NULL,
    appointment_id INT,
    patient_case VARCHAR(255),
    desciption VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (appointment_id)
        REFERENCES appointment (id)
);

CREATE TABLE medicine_prescription (
    id INT AUTO_INCREMENT NOT NULL,
    prescription_id INT,
    medicine_id INT,
    count INT,
    note VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (prescription_id)
        REFERENCES prescription (id),
    FOREIGN KEY (medicine_id)
        REFERENCES medicine (id)
);

CREATE TABLE patient_log (
    id INT AUTO_INCREMENT,
    P_name VARCHAR(50),
    appointment_date DATE,
    group_age VARCHAR(50),
    P_case VARCHAR(255),
    PRIMARY KEY (id)
);

CREATE TABLE doctor_log (
    id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    specialization VARCHAR(255),
    registerdate DATETIME,
    numberOfAppointment INT,
    PRIMARY KEY (id)
);

CREATE TABLE room_log (
    room_no INT NOT NULL,
    beds_no INT,
    numberOfPatientsInRoom INT,
    PRIMARY KEY (room_no)
);

CREATE TABLE prescription_log (
    id INT NOT NULL,
    createdate DATETIME,
    patient_case VARCHAR(255),
    desciption VARCHAR(255),
    totalMedicinesPrice INT,
    PRIMARY KEY (id)
);


/*Stored Procedures*/
/*Stored procedure #1 to get rooms based on type and price*/
DELIMITER //
CREATE PROCEDURE GetRoomByTypeAndPrice(
	IN rType VARCHAR(255),
    IN min INT,
	IN max INT
)
BEGIN
	SELECT * 
 	FROM room
	WHERE room_type = rtype AND price >= min AND price <= max ;
END //
DELIMITER ;


/*Stored procedure #2 to get rooms managed by specific nurse*/
DELIMITER //
CREATE PROCEDURE GetRoomByNurse(
	IN nid INT
)
BEGIN
	SELECT * 
 	FROM room
	WHERE nurse_id = nid;
END //
DELIMITER ;


/*Stored procedure #3 to get doctor for specific specfication*/
DELIMITER //
CREATE PROCEDURE SelectDoctorBySpecifcation(
	IN dspecification varchar(255)
)
BEGIN
	SELECT * 
 	FROM doctor
	WHERE specialization = dspecification;
    
END //
DELIMITER ;


/*Stored procedure #4 to get all doctor specialization*/
DELIMITER //
CREATE PROCEDURE SelectSpecializations(
)
BEGIN
	SELECT specialization 
 	FROM doctor;
END //
DELIMITER ;


/*Stored procedure #5 to get appointment for specific patient*/
DELIMITER //
CREATE PROCEDURE SelectAppointments(
in PName VARCHAR(255)
)
BEGIN
	SELECT patient.name,doctor.name,date,description 
 	FROM appointment join patient join doctor
	WHERE p_id = patient.id AND d_id = doctor.id AND patient.name = PName;
END //
DELIMITER ;


/*Stored procedure #6 to get medicines in prescription*/
DELIMITER //
CREATE PROCEDURE SelectMedicinesPrescription(
in appid INT,
out prid INT
)
BEGIN
	SELECT m.id,m.name,count,price,note
 	FROM prescription as p join medicine_prescription as mp join medicine as m
	WHERE appointment_id = appid AND p.id = mp.prescription_id AND m.id = mp.medicine_id;
    
    SELECT id INTO prid FROM prescription WHERE appointment_id = appid;
END //
DELIMITER ;


/*Stored procedure #7 add room for patient*/
DELIMITER //
CREATE PROCEDURE AddPatientToRoom(
IN patientId INT,
IN roomNo INT
)
BEGIN
    UPDATE patient SET r_no = roomNo WHERE id = patientId;
END //
DELIMITER ;


/*Stored procedure #8 Select patients in room*/
DELIMITER //
CREATE PROCEDURE GetPatientInRoom(
in roomNo int
)
BEGIN
    SELECT id , name from patient where r_no = roomNo;
END //
DELIMITER ;


/*Stored procedure #9 Select patients without rooms*/
DELIMITER //
CREATE PROCEDURE GetPatientNoRoom(
)
BEGIN
    SELECT id , name FROM patient WHERE r_no IS null;
END //
DELIMITER ;


/*Stored procedure #10 Select all Appointments*/
DELIMITER //
CREATE PROCEDURE GetAppointments(
)
BEGIN
SELECT appointment.id, patient.name as patientName , patient.age, doctor.name as doctorName, doctor.specialization,date
FROM appointment join patient join doctor where patient.id = p_id and doctor.id = d_id;
END //
DELIMITER ;


/*Stored procedure #11 Add Medicine In Prescription*/
DELIMITER //
CREATE PROCEDURE AddPrescriptionMedicine(
IN prid INT,
IN mid INT,
IN count INT,
IN note VARCHAR(255)
)
BEGIN
INSERT INTO medicine_prescription (prescription_id,medicine_id,count,note) values (prid,mid,count,note);
END //
DELIMITER ;


/*Functions*/
/*Function #1 to classify age of patient*/
DELIMITER //
CREATE FUNCTION AgeLevel(
    age INT
)
RETURNS VARCHAR(50)
DETERMINISTIC
BEGIN
    DECLARE ageLevel VARCHAR(50);

    IF age <= 2 THEN
		SET ageLevel = 'baby';
        
    ELSEIF (age >= 3 AND 
			age <= 39) THEN
        SET ageLevel = 'young';
        
        ELSEIF (age >= 40 AND 
			age <= 59) THEN
        SET ageLevel = 'mid_age';
        
    ELSEIF age >= 60 THEN
        SET ageLevel = 'old';
        
    END IF;
    
    	RETURN (ageLevel);
END //
DELIMITER ;


/*Function #2 check room avilability*/
DELIMITER //
CREATE FUNCTION CheckRoom(
    roomNum INT
)
RETURNS boolean
DETERMINISTIC
BEGIN
    DECLARE isAvilable BOOLEAN;
    DECLARE c int;
    DECLARE nBeds int;
    
SELECT 
    COUNT(*)
INTO c FROM
    patient
WHERE
    r_no = roomNum;
SELECT 
    beds_no
INTO nBeds FROM
    room
WHERE
    room_no = roomNum;

    IF c < nBeds THEN
		SET isAvilable = true;
        
	ELSE
		SET isAvilable = false;

    END IF;

    	RETURN (isAvilable);
END //
DELIMITER ;


/*Function #3 clear patient room*/
DELIMITER //
CREATE FUNCTION ClearPatientRoom(
    pID INT
)
RETURNS boolean
DETERMINISTIC
BEGIN
UPDATE patient SET r_no = NULL WHERE pID = id;
return true;
END //
DELIMITER ;


/*Function #4 count doctor appointments*/
DELIMITER //
CREATE FUNCTION CountDoctorAppointment(
    did INT
)
RETURNS INT
DETERMINISTIC
BEGIN
DECLARE c INT;
SELECT 
    COUNT(*) AS NumberOfAppointments
INTO c FROM
    appointment
WHERE
    d_id = did;
return c;
END //
DELIMITER ;


/*Function #5 count patient in room*/
DELIMITER //
CREATE FUNCTION CountPatientInRoom(
    rno INT
)
RETURNS INT
DETERMINISTIC
BEGIN
DECLARE c INT;
SELECT 
    COUNT(*) AS NumberOfPatients
INTO c FROM
    patient
WHERE
    r_no = rno;
return c;
END //
DELIMITER ;


/*Function #6 calculate sum of medicines in prescription*/
DELIMITER //
CREATE FUNCTION TotalCostOfMedicineInPrescription(
    pr_id INT
)
RETURNS INT
DETERMINISTIC
BEGIN
DECLARE sum INT;
SELECT 
    SUM(count * price) AS TotalCost
INTO sum FROM
    prescription AS p
        JOIN
    medicine_prescription AS md
        JOIN
    medicine AS m
WHERE
    p.id = md.prescription_id
        AND m.id = md.medicine_id
        AND p.id = pr_id;
return sum;
END //
DELIMITER ;


/*Function #7 check if appointment have prescription*/
DELIMITER //
CREATE FUNCTION CheckAppPres(
    appid INT
)
RETURNS boolean
DETERMINISTIC
BEGIN
    DECLARE c INT;
    SELECT count(*) INTO c from prescription where appointment_id = appid;
    IF c>0 THEN RETURN FALSE;	/*have prescription*/
    ELSE RETURN TRUE;			/*dosen't have prescription*/
    END IF;
END //
DELIMITER ;


/*Function #8 upercase first leter in word*/
DELIMITER //
CREATE FUNCTION CAP_FIRST (input VARCHAR(255))
RETURNS VARCHAR(255)
DETERMINISTIC
BEGIN
	DECLARE len INT;
	DECLARE i INT;

	SET len   = CHAR_LENGTH(input);
	SET input = LOWER(input);
	SET i = 0;

	WHILE (i < len) DO
		IF (MID(input,i,1) = ' ' OR i = 0) THEN
			IF (i < len) THEN
				SET input = CONCAT(
					LEFT(input,i),
					UPPER(MID(input,i + 1,1)),
					RIGHT(input,len - i - 1)
				);
			END IF;
		END IF;
		SET i = i + 1;
	END WHILE;

	RETURN input;
END//
DELIMITER ;



/*Triggers*/
/*Trigger #1 add patient log after patient prescription*/
DELIMITER //
CREATE TRIGGER after_patient_prescription
AFTER INSERT ON prescription
FOR EACH ROW
BEGIN
select name,date,AgeLevel(age),patient_case
into @n ,@d,@a,@c
from prescription join appointment join patient where appointment_id = appointment.id AND p_id = patient.id AND prescription.id = NEW.id;
INSERT INTO patient_log (P_name,appointment_date,group_age,P_case) VALUES (@n,@d,@a,@c);
END//
DELIMITER ;


/*Trigger #2 add doctor log after doctor insertion*/
DELIMITER //
CREATE TRIGGER after_doctor_insertion
AFTER INSERT ON doctor
FOR EACH ROW
BEGIN
INSERT INTO doctor_log (id,name,specialization,registerdate) VALUES (NEW.id,NEW.name,NEW.specialization,NOW());
END//
DELIMITER ;


/*Trigger #3 update doctor log after adding appointment*/
DELIMITER //
CREATE TRIGGER after_doctor_appointment
AFTER INSERT ON appointment
FOR EACH ROW
BEGIN
UPDATE doctor_log 
SET 
    numberOfAppointment = COUNTDOCTORAPPOINTMENT(NEW.d_id) WHERE id = NEW.d_id ;
END//
DELIMITER ;


/*Trigger #4 add room log after room insertion*/
DELIMITER //
CREATE TRIGGER after_room_insertion
AFTER INSERT ON room
FOR EACH ROW
BEGIN
INSERT INTO room_log (room_no,beds_no) VALUES (NEW.room_no,NEW.beds_no);
END//
DELIMITER ;


/*Trigger #5 update room log after adding patient in room*/
DELIMITER //
CREATE TRIGGER after_patient_room
AFTER UPDATE ON patient
FOR EACH ROW
BEGIN
UPDATE room_log 
SET 
    numberOfPatientsInRoom = CountPatientInRoom(NEW.r_no) WHERE room_no = NEW.r_no ;
END//
DELIMITER ;


/*Trigger #6 add prescription log after prescription insertion*/
DELIMITER //
CREATE TRIGGER after_prescription_insertion
AFTER INSERT ON prescription
FOR EACH ROW
BEGIN
INSERT INTO prescription_log (id,createdate,patient_case,desciption) VALUES (NEW.id,NOW(),NEW.patient_case,NEW.desciption);
END//
DELIMITER ;


	/*Trigger #7 update prescription log after prescription medicine insertion*/
DELIMITER //
CREATE TRIGGER after_prescription_medicine
AFTER INSERT ON medicine_prescription
FOR EACH ROW
BEGIN
UPDATE prescription_log 
SET 
    totalMedicinesPrice = TotalCostOfMedicineInPrescription(NEW.prescription_id) WHERE id = NEW.prescription_id;
END//
DELIMITER ;


/*Trigger #8 remove spaces and upper case patient name*/
DELIMITER //
CREATE TRIGGER before_patient_insertion
BEFORE INSERT ON patient
FOR EACH ROW
BEGIN
SET NEW.name = TRIM(NEW.name);
SET NEW.name = CAP_FIRST(NEW.NAME);
END//
DELIMITER ;



/*DATA INSERTION*/
/*Data for the table `doctor` */
insert  into doctor (name,gender,phone,address,specialization) values
("ahmed","male","010156153232","15-abc_st","dentist"),
("taric","male","010156153232","15-abc_st","surgery"),
("soha","female","010156153232","15-abc_st","Psychiatrist"),
("rose","female","010156153232","15-abc_st","Physical Therapist");


/*Data for the table `nurse` */
insert  into nurse (name,phone,address,specialization) values
("alexa","010156153232","15-abc_st","dentist"),
("sona","010156153232","15-abc_st","surgery"),
("mera","010156153232","15-abc_st","Psychiatrist"),
("shaza","010156153232","15-abc_st","Physical Therapist");


/*Data for the table `medicine` */
insert  into medicine (name,price) values
("Adderall",20),
("Ativan",50),
("Atorvastatin",18),
("Amitriptyline",30);


/*Data for the table `room` */
insert  into room (room_no,room_type,price,beds_no,nurse_id) values
(0,"Emergency",0,1,1),
(101,"Normal",40,4,1),
(102,"Normal",30,4,3),
(201,"VIP",200,2,2),
(202,"VIP",210,2,2);


/*Data for the table `patient` */
insert  into patient (name,phone,age,gender,address) values
("ahmed","010156153232",18,"male","15-abc_st"),
("mazen","010156153232",8,"male","15-abc_st"),
("nour","010156153232",40,"female","15-abc_st"),
("hazem","010156153232",18,"male","15-abc_st"),
("test","010156153232",18,"female","15-test"),
("semsem","010156153232",18,"male","15-abc_st"),
("ziad","010156153232",8,"male","15-abc_st"),
("bebo","010156153232",40,"male","15-abc_st");

UPDATE patient SET r_no = 101 WHERE id = 1;
UPDATE patient SET r_no = 101 WHERE id = 2;
UPDATE patient SET r_no = 201 WHERE id = 3;
UPDATE patient SET r_no = 201 WHERE id = 4;


/*Data for the table `appointment` */
insert into appointment (description,date,p_id,d_id) values
("feel something im my body","2021-03-18",1,1),
("feel something im my body","2021-03-18",2,3),
("feel something im my body","2021-03-18",3,1),
("feel something im my body","2021-03-18",4,4);


/*Data for the table `prescription` */
insert into prescription (appointment_id,patient_case,desciption) values
(1,"Mild","take a rist"),
(2,"Moderate","take a rist"),
(3,"Sever","take a rist"),
(4,"Very sever","take a rist");


/*Data for the table `medicine_prescription` */
insert into medicine_prescription (prescription_id,medicine_id,count,note) values
(1,1,1,"After Breakfast"),
(1,3,1,"Before Breakfast"),
(2,2,2,"After Breakfast , After Dinner"),
(3,4,1,"After Dinner");



/*Transactions*/
/*Transaction #1 delete patient*/
DELIMITER //
CREATE PROCEDURE DeletePatient(
IN pid INT
)
BEGIN
START TRANSACTION;

select id , d_id into @appid , @did from appointment where p_id = pid;
select id into @prid from prescription where appointment_id = @appid;
select r_no into @rno from patient where id = pid;

DELETE FROM medicine_prescription WHERE prescription_id = @prid;
DELETE FROM prescription WHERE appointment_id = @appid;
DELETE FROM appointment WHERE p_id = pid;
DELETE FROM patient WHERE id = pid;

DELETE FROM prescription_log where id = @prid;
DELETE FROM patient_log where id = pid;

UPDATE doctor_log set numberOfAppointment = CountDoctorAppointment(@did) where id = @did;
UPDATE room_log set numberOfPatientsInRoom = CountPatientInRoom(@rno) where room_no = @rno;

COMMIT;  

END //
DELIMITER ;


/*Transaction #2 insert group of patients for doctor roll back if number of appointments < 5*/
DELIMITER //
CREATE PROCEDURE transaction2(
)
BEGIN
START TRANSACTION;
insert into appointment (description,date,p_id,d_id) values
("feel something im my body","2021-03-18",7,1),
("feel something im my body","2021-03-18",6,1),
("feel something im my body","2021-03-18",5,1),
("feel something im my body","2021-03-18",4,1);
IF CountDoctorAppointment(1)<5 then COMMIT;
ELSE ROLLBACK;
END IF;  
END //
DELIMITER ;
CALL transaction2 ;


/*Transaction #3 insert unregister patient for emergency*/
DELIMITER //
CREATE PROCEDURE transaction3(
)
BEGIN
START TRANSACTION;

set @c = CountPatientInRoom(0);

insert into patient (name,age,gender,r_no) values
("asd",20,"male",0);

select LAST_INSERT_ID() into @pid;

insert into appointment (description,date,p_id,d_id) values 
("emergency","2021-02-06",@pid,1);

select LAST_INSERT_ID() into @appid;

insert into prescription (appointment_id,patient_case,desciption) values
(@appid,"VERY SEVER","make a surgery");

IF @c < 1 THEN COMMIT;
ELSE ROLLBACK;
END IF;

END //
DELIMITER ;
CALL transaction3;
SELECT COUNTPATIENTINROOM(0);


