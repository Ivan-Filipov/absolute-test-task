<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-4 text-center pt-5">
            <h1>Please sign in</h1>
            <form class="w-100" method="post" action="/auth/login">
                <div class="text-left">
                    <?php
                    if ($_SESSION['request'] && $_SESSION['request']['messages']){
                        foreach ($_SESSION['request']['messages'] as $message){
                            echo '<p> - '.$message.'</p>';
                        }
                    }
                    ?>
                </div>
                <div class="form-group">
                    <input name="name" type="text" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-2">Sign in</button>
                <a href="/register" class="btn btn-success w-100">Registration</a>
            </form>
        </div>
    </div>
</div>