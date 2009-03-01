<h2><?php echo $sf_request->getParameter('type') == FatturaPeer::CLASSKEY_VENDITA ? 'Fatture di vendita' : 'Fatture di acquisto'?></h2>

<?php if(count($invoices) > 0):?>
  <form action="<?php echo url_for('invoice/batch')?>" method="post">
  <table class="fatture" width="100%" style="margin-bottom: 5px;">
  <thead>
  <tr>
    <th></th>
    <th>N.</th>
    <th>Ragione sociale</th>
    <th>Data</th>
    <th>Totale</th>
    <th>Stato</th>
    <th>Ritardo</th>
    <th></th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($invoices as $invoice): ?>
    <tr>
      <td><input type="checkbox" name="delete[]" value="<?php echo $invoice->getId()?>"></td>
      <td><?php echo link_to($invoice->getNumFattura(), 'invoice/edit?id='.$invoice->getId()) ?></td>
      <td style="text-align: left"><?php echo link_to($invoice->getCliente()->getRagioneSociale(), 'contact/edit?id='.$invoice->getCliente()->getId(), 'target=_blank') ?></td>
      <td><?php echo $invoice->getData('d/m/Y') ?></td>
      <td><?php echo format_currency($invoice->getTotale(), '&euro;') ?></td>
      <td style="font-weight: bold; background-color: <?php echo $invoice->getColorStato()?>; color: <?php echo $invoice->getFontColorStato()?>"><?php echo $invoice->getStato(true)?></td>
      <td class="<?php echo $invoice->checkInRitardo()?'red':'none'?>"><?php echo $invoice->checkInRitardo()?'<strong>si</strong>':'no'?></td>
      <td><?php echo link_to(image_tag('/images/icons_tango/copy.png',array('alt'=>'crea copia fattura')), 'invoice/copy?id='.$invoice->getID())?></td>
      <td><?php echo link_to(image_tag('icons_tango/trash-full.png', 'alt=delete'), 'invoice/delete?id='.$invoice->getId(), 'post=true&confirm=vuoi cancellare questa fattura? title=delete') ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  </table>
  <?php echo submit_tag('Elimina', array('name' => 'delete_button', 'confirm' => 'Vuoi eliminare le fatture selezionate'))?>
  </form>
<?php else:?>
  <p>Nessuna fattura disponibile, <?php echo link_to('inserisci una nuova fattura', 'invoice/create?type='.$sf_request->getParameter('type'))?>.</p>
<?php endif?>