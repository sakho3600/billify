<div class="title">
   <h4><?php echo __('filtro')?></h4>
</div>

<form action="<?php echo url_for($filter->getRoute()); ?>" method="get"  class="form-stacked">
  <?php echo $filter; ?>
  <hr/>
  <div class="button-block">
    <input class="button" type="submit" value="Filtra" />
    <a href="<?php echo url_for($filter->getRoute()); ?>" >Reset</a>
  </div>
</form>