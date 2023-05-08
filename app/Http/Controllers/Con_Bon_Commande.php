<?php

namespace App\Http\Controllers;

use App\Models\Liste_bc;
use App\Models\BonCommande;
use App\Models\demande_achat;
use App\Models\fournisseur;
use App\Models\Proforma;
use Illuminate\Http\Request;

class Con_Bon_Commande extends Controller
{
    public function insert()
    {
        $date= $_GET['date'];
        $id_pro= $_GET['id_pro'];
        $frais= $_GET['frais'];
        $tva= $_GET['tva'];
        BonCommande::insert_cmd($date,$id_pro,$frais,$tva);
        return view('Apres_Bon_cmd',['listes'=> BonCommande::all()]);
        //return 'zay ehh ' .$date. ' id_pro ='.$id_pro.' frais '.$frais;
    }
    public function get_bc_byId()
    {
        $id=$_GET['id'];
        $data= Liste_bc::get_by_id($id);
        return view('Affiche_bc',['listes'=> $data]);
    }
    public function all_demande_achat()
    {
        $data= demande_achat::all();
        return view('liste_demande',['listes'=> $data]);
    }
    public function all_fournisseur()
    {
        $id_dem=$_GET['id_dem'];
        $data= fournisseur::all();
        return view('liste_fournisseur',['listes'=> $data,'id_dem'=>$id_dem]);
    }
    public function get_proforma_by_idCmd()
    {
        $id_dem=$_GET['id_dem'];
        $id_f=$_GET['id_f'];
        $data= Proforma::get_by_id($id_dem,$id_f);
        return view('liste_proforma',['listes'=> $data,'id_dem'=>$id_dem,'id_f'=>$id_f]);
    }
    public function insert_bc()
    {
        $id_dem=$_GET['id_dem'];
        $id_f=$_GET['id_f'];
        $data=Proforma::get_by_id($id_dem,$id_f);
        foreach($data as $dt)
        {
            if (isset($_GET['id_pro'.$dt->id_proforma]))
        {
            $date= $_GET['date'];
            $id_pro= $dt->id_proforma;
            $frais= $_GET['frais'];
            $tva= $_GET['tva'];
            BonCommande::insert_cmd($date,$id_pro,$frais,$tva);
        }
    }
    
    $data= Liste_bc::get_by_fournisseur($id_dem,$id_f);
    return view('Affiche_bc',['listes'=> $data]);
    }
    public function show_Bon_cmd()
    {
        $id_dem=$_GET['id_dem'];
        $id_f=$_GET['id_f'];
        $data= Liste_bc::get_by_fournisseur($id_dem,$id_f);
        return view('Affiche_bc',['listes'=> $data]);
    }
    public function get_non_receptionner()
    {
        $id_dem=$_GET['id_dem'];
        $data= Liste_bc::get_non_receptionner($id_dem);
        return view('bc_non_recep',['listes'=> $data]);
    }
    public function insert_reception()
    {
        $id_dem=$_GET['id_dem'];
        Liste_bc::insert_reception($id_dem);
        //return view('bc_non_recep',['listes'=> $data]);
    }
}
