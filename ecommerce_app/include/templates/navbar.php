<nav class="navbar-top navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="fas fa-home"></i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item active text-center">
          <a class="nav-link" aria-current="page" href="Admins">
            <i class="fas fa-users-cog"></i><p> Admin
          </p></a>
        </li>
        <li class="nav-item text-center">
          <a class="nav-link" aria-current="page" href="#">
            <i class="far fa-question-circle"></i><p> About</p></a>
        </li>
        <li class="nav-item text-center">
          <a class="nav-link" aria-current="page" href="#"><i class="fas fa-briefcase"></i><p> Services</p></a>
        </li>
        <li class="nav-item text-center">
          <a class="nav-link" aria-current="page" href="#"><i class="fas fa-phone"></i><p> Connect</p></a>
        </li>
      </ul>
      <a class="nav-link social" aria-current="page" href="#"><i class="fab fa-facebook"></i></a>
      <a class="nav-link social" aria-current="page" href="#"><i class="fab fa-whatsapp"></i></a>
      <a class="nav-link social" aria-current="page" href="#"><i class="fab fa-twitter"></i></a>
      <form class="d-flex" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" style="border-radius: 50px; min-width: 250px;">
        <button class="btn btn-outline-info" type="submit" style="border: none;"><i class="fas fa-search fa-lg"></i></button>
      </form>
    </div>
  </div>
</nav>
