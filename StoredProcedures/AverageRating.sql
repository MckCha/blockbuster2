DROP FUNCTION IF EXISTS RecentAverageRatings;


DELIMITER //

CREATE FUNCTION RecentAverageRatings (cDate date)
RETURNS INT DETERMINISTIC
BEGIN

    CREATE TEMPORARY TABLE T AS
    (
        SELECT * From Entertainment WHERE releaseDate >= cDate
    );

    RETURN (SELECT AVG(IMDB) FROM T);

    

END//
DELIMITER ;