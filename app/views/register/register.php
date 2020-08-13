<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-4 text-center pt-5">
            <h1>Registration</h1>
            <form class="w-100" method="post" action="/register/registration">
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
                    <select name="status" class="form-control">
                        <option selected disabled>Status</option>
                        <?php
                            foreach ($data['roles'] as $role){
                                echo "<option value='${role['id']}'>${role['status']}</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-2">Create user</button>
                <a href="/auth" class="btn btn-success w-100">To Auth</a>
            </form>
        </div>
    </div>
</div>