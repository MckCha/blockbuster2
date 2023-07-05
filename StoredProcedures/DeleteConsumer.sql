DROP PROCEDURE IF EXISTS DeleteConsumer;

DELIMITER //

CREATE PROCEDURE DeleteConsumer (cpID int(100))
BEGIN
    SELECT COUNT(*) INTO @consumerCount
    from Consumer
    WHERE pID = cpID;

    if @consumerCount > 0 THEN
        DELETE from Consumer WHERE  pID = cpID;
        DELETE from Person WHERE pID = cpID;
    ELSE
        SELECT NULL as userid, "User doesn't exist." AS 'Error';
    END IF;

END//
DELIMITER ;