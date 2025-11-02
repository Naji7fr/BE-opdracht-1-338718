-- **********************************************************************************
-- Doel: Toevoegen van een nieuw allergeen aan de tabel Allergeen
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            29-10-2025      Naji                        Nieuwe stored procedure
-- **********************************************************************************

USE magazijn;

DROP PROCEDURE IF EXISTS sp_CreateAllergeen;

DELIMITER $$

CREATE PROCEDURE sp_CreateAllergeen(
    IN p_Naam VARCHAR(30),
    IN p_Omschrijving VARCHAR(100)
)
BEGIN
    INSERT INTO Allergeen (Naam, Omschrijving)
    VALUES (p_Naam, p_Omschrijving);
END$$

DELIMITER ;