<?php
session_start();
$name = $email = $password = $invalid = null;
$errors = [];

if($_SERVER["REQUEST_METHOD"] == 'POST') {
    
    if(empty($_POST['email'])) {
        $errors['email'] = "EMAIL REQUIRED";
    } else {
        $email = $_POST['email'];
    }

    if(empty($_POST['password'])) {
        $errors['password'] = "PASSWORD REQUIRED";
    }  

try {
    $servername = "localhost";
    $username = "root";
    $sqlpassword = "";
    $database = "account";

    $obj = new PDO("mysql:host=$servername;dbname=$database", $username, $sqlpassword);
    $obj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM idpassword WHERE email = ?";
   
    $pre = $obj->prepare($query);
    $pre->execute([$email]);

    $user = $pre->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {  // FIXED: Extra parenthesis
            $_SESSION['name'] = $user['name'];  // FIXED: Changed 'nam' to 'name'
            $_SESSION['email'] = $user['email'];  // FIXED: Changed 'emai' to 'email'
            // FIXED: Removed unnecessary password session storage
            
            echo "<script>alert('Login successful!');
             window.location.href = 'dasborde.php';</script>";
        } else {
            echo "<script>alert('❌ Invalid password');</script>";
        }
    } else {
        echo "<script>alert('❌ Email not found');</script>";
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
}
?>
<!-- Rest of HTML remains same -->


<html>
<head>

<title>Login</title>

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
        <h1>LOGIN</h1>
        
        <div class="label1">
           
        <label class="label2">EMAIL
            <input type="email" name="email" value="<?php echo $email; ?>">
            <?php if(isset($errors['email'])): ?>
                <div class="error"><?php echo $errors['email']; ?></div>
            <?php endif; ?>
        </label>

        <label class="label3">PASSWORD
            <input type="password" name="password">
            <?php if(isset($errors['password'])): ?>
                <div class="error"><?php echo $errors['password']; ?></div>
            <?php endif; ?>
        </label>
        
        <?php if(isset($errors['invalid'])): ?>
                <div class="error"><?php echo $errors['invalid']; ?></div>
            <?php endif; ?>
        <button type="submit">SUBMIT</button>
        <button type="reset">RESET</button>
    </form>
</body>
</html>