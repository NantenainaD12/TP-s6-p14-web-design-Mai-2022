<div>
    <!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
    
<table border="1">
    <tr>
        <th>id_bc</th>
        <th>date_bc</th>
        <th>proforma</th>
        <th>frais</th>
        <th>tva</th>
    </tr>
<?php foreach($listes as $liste) { ?>
<tr>
    <td><?php echo $liste->id_bc ?></td>
    <td><?php echo $liste->date_bc ?></td>
    <td><?php echo $liste->proforma ?></td>
    <td><?php echo $liste->frais ?></td>
    <td><?php echo $liste->tva ?></td>
</tr>
<?php } ?>
</table>

</div>