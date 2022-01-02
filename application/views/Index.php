<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">
    <title>Go Scan!</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom-bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
</head>

<body class="bg-light">
    <!-- Appbar -->
    <nav class="navbar navbar-light bg-white shadow">
        <div class="container-fluid">
            <a class="navbar-brand text-primary me-0" href="main.html">
                <h3 class="mb-0 "><i class="fas fa-qrcode fa-fw fa-sm"></i> GoScan!</h3>
            </a>
        </div>
    </nav>

    <div class="w-auto position-absolute start-50 translate-middle mt-5">
        <?php
        if ($this->session->tempdata('notice') != NULL) {
            echo '<div class="alert alert-light shadow-sm alert-dismissible fade show" role="alert">';
            echo '<p class="mb-0 text-success"><i class="fas fa-info-circle fa-fw fa-sm me-1"></i> ' . $this->session->tempdata('notice') . '</p>';
            echo '</div>';
        }
        if ($this->session->tempdata('error') != NULL) {
            echo '<div class="alert alert-light shadow-sm alert-dismissible fade show" role="alert">';
            echo '<p class="mb-0 text-danger"><i class="fas fa-exclamation-circle fa-fw fa-sm me-1"></i> ' . $this->session->tempdata('error') . '</p>';
            echo '</div>';
        }
        ?>
    </div>
    <!-- Content  -->
    <div class="container">
        <div class="row my-3">
            <div class="col">
                <h1 class=" display-3 mb-0 text-dark">Dashboard</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-4 border-end pe-3">
                <h3 class="text-secondary fw-light">Add New Item</h3>
                <form method="post" action="<?php echo base_url(); ?>add/submit" enctype="multipart/form-data" class="row g-2">
                    <div class="col-12">
                        <input type="file" class="form-control" name="itemImg">
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control" name="itemName" placeholder="Item Name">
                    </div>
                    <div class="col-12">
                        <textarea type="text" class="form-control" name="itemDesc" max="500" row="5" placeholder="Item Description"></textarea>
                    </div>
                    <div class="col-12">
                        <div class="input-group">
                            <span class="input-group-text">RM</span>
                            <input type="number" class="form-control" name="itemPrice" placeholder="Item Price">
                        </div>
                    </div>
                    <div class="col-12">
                        <select class="form-select" name="itemStatus">
                            <option>Available</option>
                            <option>Unavailable</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
            <div class="col ps-3">
                <h3 class="text-secondary fw-light">All Item List</h3>
                <?php if (isset($items) && is_array($items) && !empty($items) && $items != false) {
                    foreach ($items as $row) { ?>
                        <div class="row bg-white rounded-3 shadow mb-2 py-2 d-flex align-items-center justify-content-center text-center">
                            <div class="col-2">
                                <p class="mb-0 text-capitalize"><?php echo $row['itemID']; ?></p>
                            </div>
                            <div class="col-2">
                                <?php
                                if ($row['itemImg'] !== null) {
                                    echo '<img src="' . base_url() . 'assets/items/' . $row['itemImg'] . '" alt="No Image" class="img-fluid" />';
                                } else {
                                    echo '<img src="https://dummyimage.com/640x360/f0f0f0/aaa" alt="No Image" class="img-fluid" />';
                                }
                                ?>
                            </div>
                            <div class="col text-start">
                                <p class="mb-0"><?php echo $row['itemName']; ?></p>
                                <p class="mb-0"><?php echo $row['itemDesc']; ?></p>
                            </div>
                            <div class="col-2">
                                RM <?php echo number_format((float)$row['itemPrice'], 2, '.', ''); ?>
                            </div>
                            <div class="col-2">
                                <?php echo $row['itemStatus']; ?>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <p>No item has been added to system yet.</p>
                <?php } ?>
            </div>
        </div>
    </div>


    <!-- Script -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>