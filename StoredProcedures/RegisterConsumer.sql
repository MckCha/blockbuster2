DROP PROCEDURE IF EXISTS RegisterConsumer;

DELIMITER //

CREATE PROCEDURE RegisterConsumer (pfName varchar(255), plName varchar(255), pDOB date, cEmail varchar(100), cPass varchar(100))
BEGIN
    SELECT COUNT(*) INTO @consumerCount
    from Consumer
    WHERE email = cEmail;

    SELECT COUNT(*) INTO @checkAll
    from Person
    WHERE fName = pfName AND lName = plName AND DOB = pDOB;


    if @consumerCount > 0 AND @checkAll > 0 THEN
        SELECT NULL as userid, "User already exists." AS 'Error';
    ELSE
        INSERT INTO Person(fName, lName, DOB) VALUES(pfName, plName, pDOB);
        SELECT pID INTO @cPID FROM Person WHERE fName = pfName AND plName = lName AND pDOB = DOB;
        INSERT INTO Consumer(pID, email, pass) VALUES(@cPID, cEmail, cPass);
    END IF;

END//
DELIMITER ;
