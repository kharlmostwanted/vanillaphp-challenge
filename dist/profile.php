<?php
session_start();
require_once('Models/User.php');
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
}

$user = User::find($_SESSION['user_id']);

$profileUpdated = false;
if (isset($_POST['updateProfile'])) {
  $hasErrors = false;

  foreach ($_POST as $key => $value) {
    if (empty($value) && $key != 'updateProfile') {
      $error = $key . ' is required';
      $hasErrors = true;
    }
  }

  if ($hasErrors == false) {
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->update();
    $profileUpdated = true;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Rudolfo's Test Blog</title>
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
  <!-- Navigation-->
  <?php include('fragments/nav.php'); ?>
  <!-- Page Header-->
  <header class="masthead" style="background-image: url('assets/img/contact-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
      <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
          <div class="page-heading">
            <h1>Profile</h1>
            <span class="subheading"></span>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Main Content-->
  <main class="mb-4">
    <div class="container px-4 px-lg-5">
      <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
          <p>Update Your Profile</p>
          <div class="my-5">
            <!-- * * * * * * * * * * * * * * *-->
            <!-- * * SB Forms Contact Form * *-->
            <!-- * * * * * * * * * * * * * * *-->
            <!-- This form is pre-integrated with SB Forms.-->
            <!-- To make this form functional, sign up at-->
            <!-- https://startbootstrap.com/solution/contact-forms-->
            <!-- to get an API token!-->
            <form method="post" id="contactForm" action="">
              <div class="form-floating">
                <input required class="form-control" name="name" id="name" value="<?php echo $user->name; ?>" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                <label for="name">Name</label>
                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
              </div>
              <div class="form-floating">
                <input required class="form-control" name="email" id="email" value="<?php echo $user->email; ?>" type="email" placeholder="Enter your email..." data-sb-validations="required,email" />
                <label for="email">Email address</label>
                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
              </div>
              <br />
              <!-- Submit success message-->
              <!---->
              <!-- This is what your users will see when the form-->
              <!-- has successfully submitted-->
              <?php if (isset($profileUpdated) && $profileUpdated == true) : ?>
                <div class="" id="submitSuccessMessage">
                  <div class="text-center mb-3">
                    <div class="fw-bolder text-success">Pofile updated!</div>
                  </div>
                </div>
              <?php endif; ?>
              <!-- Submit error message-->
              <!---->
              <!-- This is what your users will see when there is-->
              <!-- an error submitting the form-->
              <?php if (isset($error)) : ?>
                <div class="" id="submitErrorMessage">
                  <div class="text-center text-danger mb-3"><?php echo $error; ?></div>
                </div>
              <?php endif; ?>
              <!-- Submit Button-->
              <button class="btn btn-primary text-uppercase" name="updateProfile" id="submitButton" type="submit">Update Profile</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- Footer-->
  <footer class="border-top">
    <div class="container px-4 px-lg-5">
      <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="#!">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#!">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#!">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
          <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2022</div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
  <!-- * *                               SB Forms JS                               * *-->
  <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
  <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>