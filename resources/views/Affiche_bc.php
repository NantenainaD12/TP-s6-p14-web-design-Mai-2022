<div>
    <!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
 
    <?php $sum=0;$test=-$listes[0]->frais_livraison;?>
    <h1>Bon de commande</h1>
<p><strong>date</strong> :<?php echo $listes[0]->date_bc ?></p><hr><br>
<table border="1">
    <tr>
        <th>Article</th>
        <th>Quantite</th>
        <th>Prix Unitaire </th>
        <th>TVA</th>
        <th>Montant TVA</th>
        <th>Montant Ht</th>
        <th>Monatant montant_ttc </th>
    </tr>
<?php foreach($listes as $liste) { ?>
<tr>
    <td><?php echo $liste->designation ?></td>
    <td><?php echo $liste->quantite ?></td>
    <td><?php echo $liste->prix_unitaire ?></td>
    <td><?php echo $liste->tva ?></td>
    <td><?php echo $liste->montant_tva ?></td>
    <td><?php echo $liste->montant_ht ?></td>
    <td><?php echo $liste->montant_ttc ?></td>
    <?php $sum+= $liste->montant_total;$test+=$liste->frais_livraison;?>
</tr>
<?php } ?>
</table>
<hr><br>

<?php $sum-= $test;?>
<p><strong>frais_livraison</strong> :<?php echo $listes[0]->frais_livraison ?> Ar</p>
<p><strong>Monatant total</strong>  :<?php echo $sum?> AR</p>
</div>


