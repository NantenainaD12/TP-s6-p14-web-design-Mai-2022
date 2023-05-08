<h1>liste des demandes en cours</h1>
<?php foreach($listes as $liste) { ?>

   <p> <a href="all_fournisseur?id_dem=<?php echo $liste->num_demande ?>"> <?php echo $liste->date_demande ?>
    <?php echo $liste->departement ?></p> </a>


<?php } ?>
