<?php
require_once('../includes/header.php');
require_once('../Auth/db_connect.php');

?>
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="page-description">
                <h1>Facts</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Facts List</h5>
                        </div>
                        <div class="card-body">
                            <div class="example-container">
                                <div class="example-content">
                                    <table class="table">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">Serial</th>
                                                <th scope="col">Facts Icon</th>
                                                <th scope="col">Facts Count</th>
                                                <th scope="col">Facts Title</th>
                                                <th scope="col">Facts Status</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $facts_query = "SELECT * FROM facts";
                                            $facts_query_db = mysqli_query($db_connect, $facts_query);
                                            $serial = 1;
                                            foreach ($facts_query_db as  $facts) : ?>
                                                <tr>
                                                    <th><?= $serial++ ?></th>
                                                    <td>    <span class="card-text m-1 badge badge-info">
                                                        <i class="<?=$facts['facts_icon']?> fs-5" aria-hidden="true"></i></span></td>
                                                    
                                                    <td><?= $facts['facts_count'] ?></td>
                                                    <td><?= $facts['facts_title'] ?></td>
                                                    <td><span class="badge <?= ($facts['facts_status'] == 'active') ? 'badge-success' : 'badge-danger' ?>"><?= $facts['facts_status'] ?></span></td>
                                                    <td><a href="./facts_update.php?id=<?=$facts['id']?>" class="btn btn-info">edit</a> <a href="./facts_delete.php?id=<?=$facts['id']?>" class="btn btn-danger">delete</a></td>
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