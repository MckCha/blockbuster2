DROP PROCEDURE IF EXISTS ConvertMovieName;

DELIMITER //

CREATE PROCEDURE ConvertMovieName (cMovie varchar(50))
BEGIN

    SELECT Entertainment.mID FROM Reviews INNER JOIN Entertainment 
    on Entertainment.mID = Reviews.mID WHERE
    Entertainment.name = cMovie;

END//
DELIMITER ;