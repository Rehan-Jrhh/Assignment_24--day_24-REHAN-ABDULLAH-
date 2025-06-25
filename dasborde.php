<?php
session_start();

if(isset($_SESSION['name'])) {
    echo " <div class='mass'> Welcome,".$_SESSION["name"]."</div>";
    echo "<script>
    const div = document.getElementsByClassName('mass');
    const body = document.querySelector('body');
    body.append(div);
    </script>";
   
}
?>
<html>
    <head>
        <title>Dashbord</title>
        <style>

            .mass {
           position:absolute;
           right:35%;
           top:50%;
           font-size:3em;
           font-weight: 800;
           font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;

            }
            .header{
                width: 100%;
                padding:15px;
                margin:0px;
                position:absolute;
                left:0px;
                top:0px;
                background-color:red;
            }
            
            
            .label {
             
                position:absolute;
                top:2px;
                right:40px;
                cursor: pointer;
     
            }
            img {
                width: 20px;
                height: 20px;
             
            }
            .div2 {
             width: 100%;
             height: 100%;
             background-color:#00000081;
             index:3;
              }

            button {
            padding:5px;
            border:2px solid black;
            border-radius:25px; 
            color:white;
            font-weight: 800;
            background-color: #4CAF50;
        
            position:absolute;
            left:50%;
            top:50%;
              
        }
        button:hover {
            transition: all 1s ease-in;
            background-color: #f60042;
        }
        .hid {

            display :none;
        }
       
        </style>
</head>
<body>
</body>
<header class="header">
    
        <div class = "label">
       
    </div>



</header>

 <script>
    const header=document.getElementsByClassName("header");
    const imge = document.createElement("img");
    const body1 = document.querySelector('body');
    const label = document.querySelector(".label");
   
    imge.src="img.png";
    label.append(imge);
    imge.classList.add("img");
  label.addEventListener("click" , fun);
  function fun(){
    
  const div2 = document.createElement("div");
  div2.classList.add("div2");
  const buttonlogut = document.createElement("button");
  buttonlogut.textContent  = "LOGOUT";
  buttonlogut.classList.add("button");
  div2.append(buttonlogut);
  body1.append(div2);
  
   
  buttonlogut.addEventListener("click" , fun2);
  function fun2() {
  
  <?php 
    
    session_unset();
    session_destroy();
?> 
     window.location.href = "login.php";

  }
  

  }
    

 </script>




</html>