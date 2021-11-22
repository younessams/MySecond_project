<nav class="navbar navbar-expand-sm sticky-top navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="dashboard.php">Home</a>
      <div class="options collapse navbar-collapse" id="navbarsExample03">
        <ul class="navbar-nav me-auto mb-2 mb-sm-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="pages.php">members</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">Members</a>
            <ul class="dropdown-menu" aria-labelledby="dropdown03">
              <li><a class="dropdown-item" href="members.php?do=Edit&userid=<?php echo $_SESSION['userID']; ?>">Edit profil</a></li>
              <li><a class="dropdown-item" href="members.php?do=Insert&userid=<?php echo $_SESSION['userID']; ?>">Add Member</a></li>
              <li><a class="dropdown-item" href="members.php?do=Delete&userid=<?php echo $_SESSION['userID']; ?>">Delete Member</a></li>
              <li><a class="dropdown-item" href="logout.php">logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
</nav>