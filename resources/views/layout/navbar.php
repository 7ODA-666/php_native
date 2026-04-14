<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo url('/') ?>">PHP Native</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo url('/') ?>"><?php echo trans('main.home') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo url('users') ?>"><?php echo trans('main.users') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo url('login') ?>"><?php echo trans('main.login') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo url('register') ?>"><?php echo trans('main.register') ?></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if(get_local() == 'ar'): ?>
                عربي
            <?php else: ?>
                English
            <?php endif ?>
          </a>
          <ul class="dropdown-menu">
            <?php if(get_local() == 'ar'): ?>
                <li><a class="dropdown-item" href="lang?lang=en">English</a></li>
            <?php else: ?>
                <li><a class="dropdown-item" href="lang?lang=ar">عربي</a></li>
            <?php endif ?>
            
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>