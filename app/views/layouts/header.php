<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/dashboard">FDTD</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php if (isset($_SESSION['auth'])){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">Tasks dashboard</a>
                </li>
                <?php if (Person::isMother()){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/tasks/upload">Upload tasks</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="/auth/logout">Logout</a>
                </li>
            <?php } ?>
    </div>
</nav>