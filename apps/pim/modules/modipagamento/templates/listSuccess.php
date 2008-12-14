<?php
// auto-generated by sfPropelCrud
// date: 2006/09/24 16:12:02
?>
<h2>Tipologie di pagamento</h2>

<?php if(count($modo_pagamentos) > 0):?>
<table class="fatture">
<thead>
<tr>
  <th>Num giorni</th>
  <th>Descrizione</th>
  <th></th>
</tr>
</thead>
<tbody>
<?php foreach ($modo_pagamentos as $modo_pagamento): ?>
<tr>
    <td><?php echo link_to($modo_pagamento->getNumGiorni(), 'modipagamento/edit?id='.$modo_pagamento->getId()) ?></td>
    <td><?php echo $modo_pagamento->getDescrizione() ?></td>
    <td><?php echo link_to(image_tag('icons_tango/trash-full.png'), 'modipagamento/delete?id='.$modo_pagamento->getId(), 'post=true&confirm=vuoi cancellare questo tipo di pagamento?') ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>
<?php else:?>
<p>Nessuna tipologia di pagamento disponibile, <?php echo link_to('inserisci la tipologia','modipagamento/create')?>.</p>
<?php endif?>