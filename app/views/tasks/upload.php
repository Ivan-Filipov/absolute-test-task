<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-4 text-center pt-5">
            <h1>Upload new tasks</h1>
            <form class="w-100" method="post" action="/tasks/postUpload" enctype="multipart/form-data">
                <div class="text-left">
                    <?php
                    if ($_SESSION['request'] && $_SESSION['request']['messages']){
                        foreach ($_SESSION['request']['messages'] as $message){
                            echo '<p> - '.$message.'</p>';
                        }
                    }
                    ?>
                </div>
                <div class="form-group text-left">
                    <p>Select file with tasks. Each line it's task. <br>Only file with txt extension (tasks.txt).</p>
                </div>
                <div class="form-group">
                    <input name="tasks" type="file" class="w-100">
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-2">Upload</button>
            </form>
        </div>
    </div>
</div>