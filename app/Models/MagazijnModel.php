<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MagazijnModel extends Model
{
    public static function getAllProducts()
    {
        return DB::table('Product as p')
            ->leftJoin('Magazijn as m', 'p.Id', '=', 'm.ProductId')
            ->select(
                'p.Id',
                'p.Naam',
                'p.Barcode',
                'm.VerpakkingsEenheid',
                'm.AantalAanwezig',
                'p.IsActief',
                'p.DatumAangemaakt'
            )
            ->where('p.IsActief', 1)
            ->orderBy('p.Barcode', 'ASC')  // Sort by Barcode ascending
            ->get();
    }

    // Get single product by ID
    public static function getProductById($id)
    {
        return DB::table('Product')
            ->where('Id', $id)
            ->where('IsActief', 1)
            ->first();
    }

    // Get allergens for a specific product
    public static function getAllergensByProductId($id)
    {
        return DB::table('ProductPerAllergeen as ppa')
            ->join('Allergeen as a', 'ppa.AllergeenId', '=', 'a.Id')
            ->where('ppa.ProductId', $id)
            ->select('a.Naam', 'a.Omschrijving')
            ->orderBy('a.Naam', 'ASC')
            ->get();
    }

    // Get deliveries for a specific product
    public static function getDeliveriesByProductId($id)
    {
        return DB::table('ProductPerLeverancier as ppl')
            ->where('ppl.ProductId', $id)
            ->select('ppl.DatumLevering', 'ppl.Aantal', 'ppl.DatumEerstVolgendeLevering')
            ->orderBy('ppl.DatumLevering', 'ASC')
            ->get();
    }

    // Get supplier info for a specific product
    public static function getSupplierByProductId($id)
    {
        return DB::table('ProductPerLeverancier as ppl')
            ->join('Leverancier as l', 'ppl.LeverancierId', '=', 'l.Id')
            ->where('ppl.ProductId', $id)
            ->select('l.Naam', 'l.ContactPersoon', 'l.LeverancierNummer', 'l.Mobiel')
            ->first();
    }

    // Check if product has stock
    public static function hasStock($id)
    {
        $magazijn = DB::table('Magazijn')
            ->where('ProductId', $id)
            ->first();
        
        return $magazijn && $magazijn->AantalAanwezig > 0;
    }
}
