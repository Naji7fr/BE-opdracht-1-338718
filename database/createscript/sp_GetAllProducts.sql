-- **********************************************************************************
-- Doel: Ophalen van alle producten met magazijngegevens
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            29-10-2025      Naji                        Nieuwe stored procedure
-- **********************************************************************************

USE magazijn;

DROP PROCEDURE IF EXISTS sp_GetAllProducts;

DELIMITER $$

CREATE PROCEDURE sp_GetAllProducts()
BEGIN
    SELECT 
        p.Id,
        p.Naam,
        p.Barcode,
        m.VerpakkingsEenheid,
        m.AantalAanwezig
    FROM Product p
    LEFT JOIN Magazijn m ON p.Id = m.ProductId
    WHERE p.IsActief = 1;
END$$

DELIMITER ;