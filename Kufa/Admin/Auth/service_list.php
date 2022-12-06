<?php
require_once('../includes/header.php');
require_once('../Auth/db_connect.php');

?>
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="page-description">
                <h1>Services</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Service List</h5>
                        </div>
                        <div class="card-body">
                            <div class="example-container">
                                <div class="example-content">
                                    <table class="table">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">Serial</th>
                                                <th scope="col">Service Title</th>
                                                <th scope="col">Service Description</th>
                                                <th scope="col">Service Icon</th>
                                                <th scope="col">Service Status</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $service_query = "SELECT * FROM services";
                                            $service_query_db = mysqli_query($db_connect, $service_query);
                                            $serial = 1;
                                            foreach ($service_query_db as  $service) : ?>
                                                <tr>
                                                    <th><?= $serial++ ?></th>
                                                    <td><?= $service['service_title'] ?></td>
                                                    <td><?= $service['service_description'] ?></td>
                                                    <td>    <span class="card-text m-1 badge badge-info">
                                                        <i class="<?=$service['service_icon']?> fs-5" aria-hidden="true"></i></span></td>
                                                    <td><span class="badge <?= ($service['service_status'] == 'active') ? 'badge-success' : 'badge-danger' ?>"><?= $service['service_status'] ?></span></td>
                                                    <td><a href="./service_update.php?id=<?=$service['id']?>" class="btn btn-info">edit</a> <a href="../service_delete.php?id=<?=$service['id']?>" class="btn btn-danger">delete</a></td>
                                                </tr>
                                            <?php
                                            endforeach;
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once('../includes/footer.php')
?>