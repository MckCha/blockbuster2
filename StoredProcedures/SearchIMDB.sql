DROP PROCEDURE IF EXISTS SearchIMDB;

DELIMITER //
CREATE PROCEDURE SearchIMDB (eIMDB int(11))
BEGIN
    SELECT name
    from Entertainment
    WHERE IMDB = eIMDB;

END//
DELIMITER ;