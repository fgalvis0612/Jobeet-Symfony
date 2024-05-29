<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <title>Jobeet Admin Interface</title>
  <link rel="shortcut icon" href="/favicon.ico" />
  <?php use_stylesheet('admin.css') ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <?php include_javascripts() ?>
  <?php include_stylesheets() ?>
</head>

<body>
  <div id="container">
    <div id="header">
      <h1>
        <a href="<?php echo url_for('homepage') ?>">
          <img src="/images/logo.png" alt="Jobeet Job Board" />
        </a>
      </h1>
    </div>
    <?php if ($sf_user->isAuthenticated()) : ?>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div id="menu">
          <ul>
            <button type="button" class="btn btn-dark"><?php echo link_to('Jobs', 'jobeet_job') ?></button>
            <button type="button" class="btn btn-dark"><?php echo link_to('Categories', 'jobeet_category') ?></button>
            <button type="button" class="btn btn-dark"><?php echo link_to('Users', 'sf_guard_user') ?></button>
            <button type="button" class="btn btn-dark"><?php echo link_to('Logout', 'sf_guard_signout') ?></button>
          </ul>
          <li>
            <a href="<?php echo url_for('jobeet_affiliate') ?>">Affiliates<strong><?php echo Doctrine_Core::getTable('JobeetAffiliate')->countToBeActivated() ?></strong></a>
          </li>
        </div>
      </nav>

    <?php endif ?>
    <div id="content">
      <?php echo $sf_content ?>
    </div>

    <div id="footer">
      <img src="/images/symfony.png" alt="symfony framework" /></a>
    </div>
  </div>
</body>

</html>