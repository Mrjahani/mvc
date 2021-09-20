<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/bootstrap-rtl.min.css">
    <title>login</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary ">
                    <div class="panel-heading text-center">login page</div>
                    <div class="panel-body ">
                        <form action="/login" method="post">
                            <?= csrf_token() ?>
                            <div class="form-group">
                                <label for="username" class="control-label">username</label>
                                <input class="form-control" type="text" name="username">
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">password</label>
                                <input class="form-control" type="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-success">send</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>