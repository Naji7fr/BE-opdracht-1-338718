-- **********************************************************************************
-- Doel: Ophalen van leverantie-informatie per product
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            29-10-2025      Naji                        Nieuwe stored procedure
-- **********************************************************************************

USE magazijn;

DROP PROCEDURE IF EXISTS sp_GetLeverantieInfo;

DELIMITER $$

CREATE PROCEDURE sp_GetLeverantieInfo(
    IN p_ProductId MEDIUMINT
)
BEGIN
    SELECT 
        l.Naam AS LeverancierNaam,
        l.Contactpersoon,
        l.Leveranciernummer,
        l.Mobiel,
        ppl.DatumLevering,
        ppl.Aantal,
        ppl.DatumEerstVolgendeLevering
    FROM ProductPerLeverancier ppl
    INNER JOIN Leverancier l ON ppl.LeverancierId = l.Id
    WHERE ppl.ProductId = p_ProductId
    AND ppl.IsActief = 1
    ORDER BY ppl.DatumLevering DESC;
END$$

DELIMITER ;