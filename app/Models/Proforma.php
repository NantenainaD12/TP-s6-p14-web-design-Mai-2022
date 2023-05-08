<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Proforma extends Model
{
    protected $table='vrai_proforma';
    use HasFactory;
    public static function get_by_id($id_dem,$id_f)
    {
        try {
            $sql="select * from vrai_proforma where id_demande=$id_dem and fournisseur=$id_f and id_proforma not in (select proforma from bon_commandes)";
           // $val= Proforma::where([['id_demande','=',$id_dem],['fournisseur','=',$id_f]])->get();
           $val=DB::select($sql);
            return $val;
        }  catch (\Throwable $th) {
            throw $th;
        }
    }
}
