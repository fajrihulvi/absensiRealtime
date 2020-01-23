<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Error 404</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url()?>assets/admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/admin/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/admin/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url()?>assets/admin/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url()?>assets/admin/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center text-center error-page bg-primary">
        <div class="row flex-grow">
          <div class="col-lg-7 mx-auto text-white">
            <div class="row align-items-center d-flex flex-row">
              <div class="col-lg-6 text-lg-right pr-lg-4">
                <h1 class="display-1 mb-0">404</h1>
              </div>
              <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                <h2>SORRY!</h2>
                <h3 class="font-weight-light"><?php echo $message; ?></h3>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12 text-center mt-xl-2">
                <a class="text-white font-weight-medium" href="<?= site_url()?>">Back to home</a>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12 mt-xl-2">
                <p class="text-white font-weight-medium text-center">Copyright &copy; <?=date('Y')?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?= base_url()?>assets/admin/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?= base_url()?>assets/admin/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?= base_url()?>assets/admin/js/off-canvas.js"></script>
  <script src="<?= base_url()?>assets/admin/js/misc.js"></script>
  <!-- endinject -->
</body>

</html>