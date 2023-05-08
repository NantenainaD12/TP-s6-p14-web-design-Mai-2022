<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Liste_bc extends Model
{
    protected $table="v_bc";
    protected $primaryKey='id_bc';
    use HasFactory;

    public static function get_by_id($id_bc)
    {
        try {
            $val= Liste_bc::where('id_bc',$id_bc)->get();
            return $val;
        }catch (\Throwable $th) {
            //throw $th;
        }
    }
    public static function get_by_fournisseur($id_dem,$id_f)
    {
        try {
            $val= Liste_bc::where([['id_demande','=',$id_dem],['id_fournisseur','=',$id_f]])->get();
            return $val;
        }  catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function get_non_receptionner($id_bc)
    {
        try {
            $val= DB::table('commande_non_recu')->where('id_demande',$id_bc)->get();
            return $val;
        }catch (\Throwable $th) {
            //throw $th;
        }
    }
    public static function insert_reception($id_bc)
    {
        try {
            $val= DB::table('commande_non_recu')->where('id_demande',$id_bc)->get();
            foreach($val as $vv)
            {
                DB::insert('insert into reception(id_bc) values ('.$vv->id_bc.')');
            }
           
        }catch (\Throwable $th) {
            throw $th;
        }
    }
}
