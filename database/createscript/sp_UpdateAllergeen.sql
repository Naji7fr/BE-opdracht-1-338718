-- **********************************************************************************
-- Doel: Bijwerken van een bestaand allergeen in de tabel Allergeen
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            29-10-2025      Naji                        Nieuwe stored procedure
-- **********************************************************************************

USE magazijn;

DROP PROCEDURE IF EXISTS sp_UpdateAllergeen;

DELIMITER $$

CREATE PROCEDURE sp_UpdateAllergeen(
    IN p_Id SMALLINT,
    IN p_Naam VARCHAR(30),
    IN p_Omschrijving VARCHAR(100)
)
BEGIN
    UPDATE Allergeen 
    SET Naam = p_Naam,
        Omschrijving = p_Omschrijving,
        DatumGewijzigd = NOW(6)
    WHERE Id = p_Id;
END$$

DELIMITER ;