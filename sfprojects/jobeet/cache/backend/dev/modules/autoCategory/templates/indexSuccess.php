<?php use_helper('I18N', 'Date') ?>
<?php include_partial('category/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Category Management', array(), 'messages') ?></h1>

  <?php include_partial('category/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('category/list_header', array('pager' => $pager)) ?>
  </div>

<div class="row">
  <div id="sf_admin_content" class="col-sm-8 col-md-9">
    <?php include_partial('category/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('category/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('category/list_actions', array('helper' => $helper)) ?>
    </ul>
  </div>
</div>
  <div id="sf_admin_footer">
    <?php include_partial('category/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
