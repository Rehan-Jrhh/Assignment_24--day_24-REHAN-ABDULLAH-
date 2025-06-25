<?php
$name = $email = $password = null;
$ename = $eemail = $epassword = null;
$errors = [];

if($_SERVER["REQUEST_METHOD"] == 'POST') {
    if(empty($_POST['name'])) {
        $errors['ename'] = "NAME REQUIRED";
    } else {
        $name = $_POST['name'];
    }

    if(empty($_POST['email'])) {
        $errors['eemail'] = "EMAIL REQUIRED";
    } else {
        $email = $_POST['email'];
    }

    if(empty($_POST['password'])) {
        $errors['epassword'] = "PASSWORD REQUIRED";
    } else {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
       
    }
}


    $servername = "localhost";
    $username = "root";
    $sqlpassword = "";
    $database = "account";

    try {
        $obj = new PDO("mysql:host=$servername;dbname=$database",$username,$sqlpassword);
        $obj->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query = "INSERT INTO idpassword(name,email,password)VALUES(?,?,?)";
        $pre = $obj->prepare($query);
        $pre->execute([$name, $email, $password]); 
    }
    catch (PDOException $e){
        echo "Error: ".$e->getMessage();
    }

?>

<html>
<head>
    <title>Registration</title>
    <style>
        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            display:flex;
            justify-content:center;
        }
        .form {
            border: 2px solid black;
            width:25%;
            height: max-content;
            padding: 10px;
            display: flex;
            flex-direction: column;
            gap:10px;
        }
        h1 {
            font-size: 20px;
            margin:-9px;
            padding:5px;
            text-align:center;
        }
        label {
            display:flex;
            flex-direction:column;
        }
        .error {
            color: red;
            font-size: 12px;
        }
        button {
            padding:5px;
            border:2px solid black;
            border-radius:25px; 
            color:white;
            font-weight: 800;
            background-color: #4CAF50;
        }
        button:hover {
            transition: all 1s ease-in;
            background-color: #f60042;
        }
    </style>
</head>
<body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form">
        <h1>Registration</h1>
        
        <div class="label1">
            <label>NAME
                <input type="text" name="name" value="<?php echo $name; ?>">
                <?php if(isset($errors['ename'])): ?>
                    <div class="error"><?php echo $errors['ename']; ?></div>
                <?php endif; ?>
            </label>
        </div>

        <label class="label2">EMAIL
            <input type="email" name="email" value="<?php echo $email; ?>">
            <?php if(isset($errors['eemail'])): ?>
                <div class="error"><?php echo $errors['eemail']; ?></div>
            <?php endif; ?>
        </label>

        <label class="label3">PASSWORD
            <input type="password" name="password">
            <?php if(isset($errors['epassword'])): ?>
                <div class="error"><?php echo $errors['epassword']; ?></div>
            <?php endif; ?>
        </label>

        <button type="submit">SUBMIT</button>
    </form>
</body>
</html>