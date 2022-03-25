<?php 
    $connection = new PDO('mysql:host=192.168.0.250;dbname=db', 'root', 'senha');
    $option = isset($_POST['option']) 
        ? $_POST['option']
        : "list";
    if ($option === "save") {
        $name = isset($_POST['name']) 
            ? $_POST['name']
            : null;
        if (!is_null($name)){
            $st = $connection->prepare("INSERT INTO peoples (name) values(?)");
            if ($st->execute([$name])) {
                header("Location: index.php");
                exit();
                die();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People</title>
</head>
<body>
    <h1 style="border-bottom: 1px solid #EFEFEF;margin:0">Cadastro</h1>
    <div style="margin-top:10px">
        <form action="index.php" method="post">
            <input type="hidden" name="option" value="save" />
            <input type="text" name="name" maxlength="100" required autofocus/>
            <button>Gravar</button>
        </form>
    </div>
    <div style="margin-top:10px">
        <table border="0" width="100%;border:1px solid #EFEFEF;">
            <tr>
                <td style="width:10%;text-align:center">Id</td>
                <td style="width:90%;text-align:center">Name</td>
            </tr>
            <?php foreach($connection->query("SELECT * FROM peoples") as  $row): ?>
            <tr>
                <td style="width:10%;text-align:center"><?php echo $row['id'];?></td>
                <td style="width:90%;text-align:left"><?php echo $row['name'];?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php
        unset($connection);
    ?>
</body>
</html>