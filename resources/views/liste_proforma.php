<h1>liste des pro</h1>
<table border="1">
    <tr>
        <th>id_proforma</th>
        <th>nom_article</th>
        <th>delai</th>
        <th>lieu</th>
        <th>fournisseur</th>
        <th>check</th>
    </tr>
<form method="get" action="insert_bc">
<?php foreach($listes as $liste) { ?>
<tr>
    <td><?php echo $liste->id_proforma ?></td>
    <td><?php echo $liste->nom_article ?></td>
    <td><?php echo $liste->delai ?></td>
    <td><?php echo $liste->lieu ?></td>
    <td><?php echo $liste->fournisseur ?></td>
    <td><input type="checkbox" id="music" name="id_pro<?php echo $liste->id_proforma ?>" value="<?php echo $liste->id_proforma ?>"></td>
</tr>
<?php } ?>

<input name="id_dem" value=<?php echo $id_dem?> hidden>
<input name="id_f" value=<?php echo $id_f?> hidden>
</table>

<p><input name="date"  placeholder="date" type="text"></p>
<p><input name="frais"  placeholder="frais" type="text"></p>
<p><input name="tva"  placeholder="tva" type="text"></p>

<input type="submit" value="valider">
</form>
<a href="show_Bon_cmd?id_dem=<?php echo $id_dem?>&id_f=<?php echo $id_f?>">show Bon_cmd</a>
<a href="show_Bon_cmd_a_valider?id_dem=<?php echo $id_dem?>&id_f=<?php echo $id_f?>">Valider bc</a>
