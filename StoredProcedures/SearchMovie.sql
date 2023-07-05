DROP PROCEDURE IF EXISTS SearchMovie;

DELIMITER //

CREATE PROCEDURE SearchMovie (eName varchar(50))
BEGIN
    SELECT *
    from Entertainment
    WHERE name = eName;

END//
DELIMITER ;