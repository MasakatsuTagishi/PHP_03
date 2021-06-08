<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>入力画面</title>
    </head>
    <body>
        <form action="todo_create.php" method="POST">
            <fieldset>
                <legennd>入力画面</legennd>
                <a href="todo_read.php">一覧画面</a>
                <div>
                    username: <input type="text" name="username">
                </div>
                <div>
                    password: <input type="password" name="password">
                </div>
                <div>
                    <button>submit</button>
                </div>
            </fieldset>
        </form>    
    </body>
</html>