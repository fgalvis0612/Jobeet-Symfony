<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <title>
    <?php if (!include_slot('title')) : ?>
      Jobeet - Your best job board
    <?php endif; ?>
  </title>
  <link rel="shortcut icon" href="/favicon.ico" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <?php include_javascripts() ?>
  <?php include_stylesheets() ?>
  <link rel="alternate" type="application/atom+xml" title="Latest Jobs" href="<?php echo url_for('job', array('sf_format' => 'atom'), true) ?>" />
</head>

<body>
  <div id="container">
    <div id="header">
      <div class="content">
        <h1>
          <a href="<?php echo url_for('@homepage') ?>">
            <img src="/images/logo.png" alt="Jobeet Job Board" />
          </a>
        </h1>
        <div class="card">
          <div class="card-header">
            Jobeet
          </div>
          <div class="card-body">
            <a href="<?php echo url_for('job/index') ?>" class="btn btn-primary">INICIO</a>
            <a href="<?php echo url_for('@job_new') ?>" class="btn btn-primary">Post a Job</a>
            <h2>Preguntar por trabajo</h2>
            <div class="input-group mb-3">
              <input type="text" name="keywords" id="search_keywords" class="form-control" placeholder="Enter some keywords (city, country, position, ...)" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Buscar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div></br>

  <div id="content">
    <?php if ($sf_user->hasFlash('notice')) : ?>
      <div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
    <?php endif ?>

    <?php if ($sf_user->hasFlash('error')) : ?>
      <div class="flash_error"><?php echo $sf_user->getFlash('error') ?></div>
    <?php endif ?>

    <div id="job_history">
      Recent viewed jobs:
      <ul>
        <?php foreach ($sf_user->getJobHistory() as $job) : ?>
          <li>
            <?php echo link_to($job->getPosition() . ' - ' . $job->getCompany(), 'job_show_user', $job) ?>
          </li>
        <?php endforeach ?>
      </ul>
    </div>

    <div class="content">
      <?php echo $sf_content ?>
    </div>
  </div>

  <div id="footer" class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
      <span class="symfony">
        <img src="/images/symfony.png" alt="symfony framework" />
        </a>
      </span>
      <ul>
        <a href="">About Jobeet</a>
        <li class="feed">
          <a href="<?php echo url_for('job', array('sf_format' => 'atom')) ?>">Full feed</a>
        </li>
        <a href="">Jobeet API</a>
        <li class="last">
          <a href="<?php echo url_for('affiliate_new') ?>">Become an affiliate</a>
        </li>
      </ul>
    </div>
  </div>
  </div>
</body>

</html>