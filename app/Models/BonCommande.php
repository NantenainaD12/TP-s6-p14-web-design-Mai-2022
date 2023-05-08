<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BonCommande extends Model
{
    protected $table="bon_commande";
    use HasFactory;
 public static function insert_cmd($date,$id_pro,$frais,$tva)
    {
        try {
            DB::insert(
            "INSERT INTO bon_commande(date_bc,proforma,frais,tva) VALUES(?,?,?,?)",
            [
                $date,$id_pro,$frais,$tva
            ]
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
