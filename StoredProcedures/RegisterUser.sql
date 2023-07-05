DROP PROCEDURE IF EXISTS RegisterUser;

DELIMITER //

CREATE PROCEDURE RegisterUser (cUsername char(50), cPassword char(50))
BEGIN
    SELECT COUNT(*) INTO @userCount
    from user
    WHERE username = cUsername;


    if @userCount > 0 THEN
        SELECT NULL as user_ID, "User already exists." AS 'Error';
    ELSE
        INSERT INTO user(username, password) VALUES(cUsername, cPassword);
    END IF;

END//
DELIMITER ;
