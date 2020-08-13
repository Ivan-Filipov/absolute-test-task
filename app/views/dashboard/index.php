<div class="container">
    <div class="row justify-content-md-center pt-5">
        <h1>Dashboard for <?php echo $_SESSION['auth']['name'] ?></h1>
        <h2 class="w-100 text-center">My tasks</h2>
        <div class="w-100">
            <div class="list-group">
                <?php
                    foreach ($data['tasks'] as $task){
                        if ($task['implementer'] === $_SESSION['auth']['id']){
                            ?>
                            <div class="list-group-item flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?php echo $task['name'] ?></h5>
                                    <small><?php echo $task['time_create'] ?></small>
                                </div>
                                <?php
                                if (!Person::isFather() || $task['done']) {
                                    $implementer = 'n/a';
                                    foreach ($data['persons'] as $person) {
                                        if ($task['implementer'] === $person['id']) {
                                            $implementer = $person['name'];
                                        }
                                    }
                                    ?>
                                    <p class="mb-1">Implementer: <?php echo $implementer ?></p>
                                <?php }else{ ?>
                                    <form action="/tasks/implementer/<?php echo $task['id']; ?>" method="post">
                                        <p class="mb-1">Implementer:
                                            <select name="implementer" class="ml-2" onchange="this.form.submit()">
                                                echo "<option selected disabled></option>";
                                                <?php
                                                foreach ($data['persons'] as $person) {
                                                    if ($person['id'] === $task['implementer']) {
                                                        echo "<option value='${person['id']}' selected>${person['name']}</option>";
                                                    } else {
                                                        echo "<option value='${person['id']}'>${person['name']}</option>";
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </p>
                                    </form>
                                <?php } ?>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small>Done: <?php echo $task['done'] ? 'yes' : 'no' ?></small>
                                    <div class="d-flex justify-content-between">
                                        <?php if (!$task['done'] && $task['implementer'] === $_SESSION['auth']['id']){ ?>
                                            <div>
                                                <form action="/tasks/done/<?php echo $task['id']; ?>" method="post">
                                                    <input type="submit" class="btn btn-success" value="Done">
                                                </form>
                                            </div>
                                        <?php } ?>
                                        <?php if (Person::isMother() && !$task['done']){ ?>
                                            <div class="ml-2">
                                                <form action="/tasks/delete/<?php echo $task['id']; ?>" method="post">
                                                    <input type="submit" class="btn btn-danger" value="Delete">
                                                </form>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
        <h2 class="w-100 text-center">Other tasks</h2>
        <div class="w-100">
            <div class="list-group mb-5">
                <?php
                    foreach ($data['tasks'] as $task){
                        if ($task['implementer'] !== $_SESSION['auth']['id']){
                ?>
                    <div class="list-group-item flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?php echo $task['name'] ?></h5>
                            <small><?php echo $task['time_create'] ?></small>
                        </div>
                        <?php
                            if (!Person::isFather() || $task['done']) {
                                $implementer = 'n/a';
                                foreach ($data['persons'] as $person) {
                                    if ($task['implementer'] === $person['id']) {
                                        $implementer = $person['name'];
                                    }
                                }
                        ?>
                        <p class="mb-1">Implementer: <?php echo $implementer ?></p>
                        <?php }else{ ?>
                            <form action="/tasks/implementer/<?php echo $task['id']; ?>" method="post">
                                <p class="mb-1">Implementer:
                                    <select name="implementer" class="ml-2" onchange="this.form.submit()">
                                        echo "<option selected disabled></option>";
                                        <?php
                                            foreach ($data['persons'] as $person) {
                                                if ($person['id'] === $task['implementer']) {
                                                    echo "<option value='${person['id']}' selected>${person['name']}</option>";
                                                } else {
                                                    echo "<option value='${person['id']}'>${person['name']}</option>";
                                                }
                                            }
                                        ?>

                                    </select>
                                </p>
                            </form>
                        <?php } ?>
                        <div class="d-flex justify-content-between align-items-center">
                            <small>Done: <?php echo $task['done'] ? 'yes' : 'no' ?></small>
                            <div class="d-flex justify-content-between">
                                <?php if (!$task['done'] && $task['implementer'] === $_SESSION['auth']['id']){ ?>
                                    <div>
                                        <form action="/tasks/done/<?php echo $task['id']; ?>" method="post">
                                            <input type="submit" class="btn btn-success" value="Done">
                                        </form>
                                    </div>
                                <?php } ?>
                                <?php if (Person::isMother() && !$task['done']){ ?>
                                    <div class="ml-2">
                                        <form action="/tasks/delete/<?php echo $task['id']; ?>" method="post">
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>