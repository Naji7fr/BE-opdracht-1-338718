-- **********************************************************************************
-- Doel: Ophalen van leveranciersinformatie
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            29-10-2025      Naji                        Nieuwe stored procedure
-- **********************************************************************************

USE magazijn;

DROP PROCEDURE IF EXISTS sp_GetLeverancierInfo;

DELIMITER $$

CREATE PROCEDURE sp_GetLeverancierInfo()
BEGIN
    SELECT * FROM Leverancier WHERE IsActief = 1;
END$$

DELIMITER ;