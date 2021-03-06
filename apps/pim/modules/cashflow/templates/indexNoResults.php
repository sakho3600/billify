<div class="title">
  <h2>
    <?php echo __('Cash Flow')?>
    <?php if ($sf_user->hasFlash('notice')): ?>
      <span class="notice">- <?php echo __($sf_user->getFlash('notice')); ?></span>
    <?php endif; ?>
  </h2>
</div>

<p><?php echo __('No entrances in cash flow.');?></p>

<?php
  slot('sidebar');
    include_partial('cashflow/sidebar');
  end_slot();
?>

<?php
  slot('infobox');
    include_partial('cashflow/filter', array('filter' => $filter));
  end_slot();
?>