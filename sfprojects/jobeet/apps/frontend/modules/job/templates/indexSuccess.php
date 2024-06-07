<h1>Lista de trabajos</h1>

<div id="jobs">
  <?php foreach ($categories as $category) : ?>

    <div class="card">
      <h2 class="card-header"> <?php echo __(link_to($category, 'category', $category))?>

        <div class="feed">
          <a href="<?php echo url_for('category', array('sf_subject' => $category, 'sf_format' => 'atom')) ?>">Feed</a>
        </div>

      </h2>

      <div class="card-body">
        <?php include_partial('job/list', array('jobs' => $category->getActiveJobs(sfConfig::get('app_max_jobs_on_homepage')))) ?>
        <?php if (($count = $category->countActiveJobs() -
          sfConfig::get('app_max_jobs_on_homepage')) > 0) : ?>
          <div class="more_jobs">
            <?php echo __('and %count% more...', array('%count%' => link_to($count, 'category', $category))) ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
    </div>


    <a class="btn btn-success" href="<?php echo url_for('job/new') ?>">NUEVO</a>