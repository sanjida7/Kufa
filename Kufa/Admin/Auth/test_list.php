<?php
require_once('../includes/header.php');
require_once('../Auth/db_connect.php');

?>
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="page-description">
                <h1>Testimonial</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Testimonial List</h5>
                        </div>
                        <div class="card-body">
                            <div class="example-container">
                                <div class="example-content">
                                    <table class="table">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">Serial</th>
                                                <th scope="col">Testimonial image</th>
                                                <th scope="col">Testimonial comment</th>
                                                <th scope="col">Testimonial name</th>
                                                <th scope="col">Testimonial title</th>
                                                <th scope="col">Testimonial Status</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $testi_query = "SELECT * FROM testimonials";
                                            $testi_query_db = mysqli_query($db_connect, $testi_query);
                                            $serial = 1;
                                            foreach ($testi_query_db as  $testi) : ?>
                                                <tr>
                                                    <th><?= $serial++ ?></th>
                                                    <td><img src="../uplods/profile/works/<?= $testi['image'] ?>" alt="" width="100" height="120"></td>
                                                    <td><?= $testi['comment'] ?></td>
                                                    <td><?= $testi['name'] ?></td>
                                                    <td><?= $testi['title'] ?></td>
                                                    
                                                    <td><span class="badge <?= ($testi['status'] == 'active') ? 'badge-success' : 'badge-danger' ?>"><?= $testi['status'] ?></span></td>
                                                    <td><a href="./test_update.php?id=<?=$testi['id']?>" class="btn btn-info">edit</a> <a href="./test_delete.php?id=<?=$testi['id']?>" class="btn btn-danger">delete</a></td>
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