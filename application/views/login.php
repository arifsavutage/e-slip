<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>

<body>
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6>E-slip Login</h6>
                    </div>
                    <form name="login" method="post" action="">
                        <div class="card-body">
                            <?php
                            if ($this->session->flashdata('message')) {
                                echo $this->session->flashdata('message');
                            }
                            ?>
                            <div class="form-group">
                                <label for="text">Username</label>
                                <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="Username">
                                <span class="text-danger"><?php echo form_error('username'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <span class="text-danger"><?php echo form_error('password'); ?></span>
                            </div>
                            <div class="form-group">
                                <?= $captcha_img ?>
                            </div>
                            <div class="form-group mt-2">
                                <?php
                                $sess_cap = $this->session->userdata('captcha');
                                echo "<input type='hidden' name='code_captcha' value='$sess_cap' />"
                                ?>
                                <input type="text" name="captchaku" maxlength="5" class="form-control form-control-user" id="captchaku" placeholder="Masukkan kode captcha">
                                <span class="text-danger"><?php echo form_error('captchaku'); ?></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-dark">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>