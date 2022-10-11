<?php 
            
    $uri = service('uri');

?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item <?= ($uri->getSegment(1) == '' ? 'active' : null)?>">
            <a class="nav-link" aria-current="page" href="/">Home</a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php if (session()->get('isLoggedIn')): ?>
                <li class="nav-item dropdown">
                   <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                       <?= session()->get('first_name'); ?>
                   </a>
                   <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                       <a class="dropdown-item" href="/profile">Profile</a>
                       <div class="dropdown-divider"></div>
                       <a class="dropdown-item" href="/logout">Log Out</a>
                   </div>
                </li>
            <?php else: ?>
               <li class="nav-item <?= ($uri->getSegment(1) == 'login' ? 'active' : null)?>">
                   <a class="nav-link" href="/login">Login</a>
               </li>
            <?php endif; ?>

        <ul>
      </div>
    </div>
</nav>