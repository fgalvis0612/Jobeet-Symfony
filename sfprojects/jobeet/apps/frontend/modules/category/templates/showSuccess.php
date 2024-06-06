<?php use_stylesheet('jobs.css') ?>

<?php slot('title', sprintf('Jobs in the %s category', $category->getName())) ?>

<div class="category">
  <div class="feed">
    <div class="feed">
      <a href="<?php echo url_for('category', array('sf_subject' => $category, 'sf_format' => 'atom')) ?>">Feed</a>
    </div>
  </div>
  <h1><?php echo $category ?></h1>
</div>

<?php include_partial('job/list', array('jobs' => $pager->getResults())) ?>


<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-end">
    <li class="page-item">
      <a class="page-link" href="<?php echo url_for('category', $category) ?>?page=<?php echo $pager->getPreviousPage() ?>">Anterior</a>
    </li>
    <?php foreach ($pager->getLinks() as $page) : ?>
      <?php if ($page == $pager->getPage()) : ?>
        <li class="page-item disabled"><a class="page-link"><?php echo $page ?></a></li>
      <?php else : ?>
        <li class="page-item"><a class="page-link" href="<?php echo url_for('category', $category) ?>?page=<?php echo $page ?>"><?php echo $page ?></a></li>
      <?php endif; ?>
    <?php endforeach; ?>
    <li class="page-item">
      <a class="page-link" href="<?php echo url_for('category', $category) ?>?page=<?php echo $pager->getNextPage() ?>">Siguiente</a>
    </li>
  </ul>
</nav>
<div class="pagination justify-content-end">
  <?php echo format_number_choice(
    '[0]No job in this category|[1]One job in this category|(1,+Inf]%count% jobs in this category',
    array('%count%' => '<strong>' . count($pager) . '</strong>'),
    count($pager)
  )
  ?>

  <?php if ($pager->haveToPaginate()) : ?>
    - page <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
  <?php endif; ?>
</div>