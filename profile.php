<?php
    include("Edit_Profile.php");
?>

<?php
    include("user_login.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Account settings
        </h4>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-general">General</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <form method="POST">
                                    <div class="form-group">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control mb-1" value="<?php echo isset($_SESSION['Username']) ? $_SESSION['Username'] : ''; ?>" name="Username">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input type="text" class="form-control mb-1" value="<?php echo isset($_SESSION['Email']) ? $_SESSION['Email'] : ''; ?>" name="Email" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" value="" name="Password">
                                    </div>

                                    
                                    <div class="form-group">
                                        <label class="form-label">Phone</label>
                                        <input type="tel" class="form-control" value="" name="SDT">
                                    </div>

                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                                        <a href="logined.php" class="btn btn-default">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                       
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>
</body>

</html>