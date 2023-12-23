<?php 

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - E-Learning PT. Southern of Sumatera</title>
    <link rel="stylesheet" href="public/assets/css/main/app.css" />
    <link rel="shortcut icon" href="public/assets/images/logo/logo-ptsos.png" type="image/x-icon" />
    <link rel="shortcut icon" href="public/assets/images/logo/logo-ptsos.png" type="image/png" />

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- local css -->
    <link rel="stylesheet" href="public/assets/css/pages/style.css" />
</head>

<style>
body {
    background: url(../../../assets/images/4853433.png?45649b87e0b3f50bfa1372c6cdb4595f), linear-gradient(90deg, #2d499d, #3f5491);
}
</style>

<body>
    <div id="auth">
        <div class="row justify-content-center mt-5">
            <div class="col-7">
                <div class="card shadow rounded-4 mt-3">
                    <div class="row justify-content-center">
                        <div class="col-7">
                            <img src="public/assets/images/logo/logo-ptsos.png" alt="Logo" width="460" />
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-9 mb-5">
                            <!-- Notifikasi Gagal login -->
                            <?php
                            if (isset($_SESSION['gagal'])) {
                            ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Failed!</strong> <?= $_SESSION['gagal']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php
                                unset($_SESSION['gagal']);
                            }
                            ?>
                            <?php
                            if (isset($_SESSION['error'])) {
                            ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Failed!</strong> <?= $_SESSION['error']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php
                                unset($_SESSION['error']);
                            }
                            ?>
                            <h3 class="auth-title">Log in.</h3>
                            <p class="auth-subtitle mb-2">
                                Log in using company account.
                            </p>

                            <form action="cek_login.php" method="post">
                                <div class="form-group position-relative has-icon-left mb-3">
                                    <input type="email" class="form-control form-control-lg rounded-3"
                                        placeholder="Email" name="email" />
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left mb-3">
                                    <input type="password" class="form-control form-control-lg rounded-3"
                                        placeholder="Password" name="password" />
                                    <div class="form-control-icon">
                                        <i class="bi bi-shield-lock"></i>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01"><i
                                            class="bi bi-card-list"></i></label>
                                    <select class="form-select form-select-md rounded-3"
                                        aria-label=".form-select-lg example" id="inputGroupSelect01" name="user_type">
                                        <option selected disabled value>-- Choose Position --</option>
                                        <option value="direktur">Direktur</option>
                                        <option value="admin">Admin</option>
                                        <option value="instruktur">Instruktur</option>
                                        <option value="users">Pegawai</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg my-3">
                                    Log in
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

</body>

</html>