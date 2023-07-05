DROP PROCEDURE IF EXISTS SearchPlatform;

DELIMITER //

CREATE PROCEDURE SearchPlatform (pName varchar(50))
BEGIN
    CREATE TEMPORARY Table Plat AS (
        SELECT * from Platforms 
        WHERE pName = pURL
    );

    SELECT name
    from Entertainment
    NATURAL JOIN Has 
    NATURAL JOIN Plat;

END//
DELIMITER ;