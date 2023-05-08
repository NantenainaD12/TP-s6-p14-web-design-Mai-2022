<h1>liste des fournisseur</h1>
<?php foreach($listes as $liste) { ?>

   <p>  <?php echo $liste->id_fournisseur ?>
   <a href="all_proforma?id_dem=<?php echo $id_dem?>&id_f=<?php echo $liste->id_fournisseur ?>"> 
   <?php echo $liste->nom_fournisseur ?></p> </a>

<?php } ?>
