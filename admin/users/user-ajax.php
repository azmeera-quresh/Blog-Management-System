<head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>blog management</title>
   <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="admincss.css">
</head>
<body>

<?php
require_once 'admin-sidebar.php'; 
require_once("../admin-header.php");
  require_once("../../require/connection.php");
?>

<div class="container-fluid">
<div class="row">
<div class="col-md-2 g-0 ">
	<?php //require_once '../admin-sidebar.php'; ?>
</div>
  <div class="col-md-10 mt-5 "> 
  	
<h3  class="p-1 ">HELLO ADMIN!</h3>
<hr style="width:100%; height:4px; background-color: black" >
    <center>
      <div id="msg"></div>

    <button onclick="get_form()" class="btn btn-primary">Add User</button>
      <div id="form"> 
        
      </div>
      <hr style="border:1px solid white">
      <div id="show_users">
      </div>
    </center>
    <script>

      // get_form();
      show_users();
      function add_user(){
        /*alert("hi")*/
        var first_name = document.getElementById("fname").value;
            var last_name = document.getElementById("lname").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("pass").value;
            var gender = document.getElementById("gender").value;
            // alert(gender);
            var dob = document.getElementById("dob").value;
            var image = document.getElementById("image").value;
            var address = document.getElementById("addrs").value;


/*
        alert(address)
        alert(first_name)
        alert(last_name)
        alert(email)
        alert(gender_male)
        alert(dob)
        alert(image)
        alert(gender_female)*/

        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.open("POST","ajax-processing.php",true);
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=add_user&first_name="+first_name+"&last_name="+last_name+"&email="+email+"&password="+password+"&gender="+gender+"&dob="+dob+"&image="+image+"&address="+address);

        

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            // alert(this.responseText);
            document.getElementById("msg").innerHTML=this.responseText;
            show_users();
            cancel();
          }
        }
      }
      function show_users(){
        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("show_users").innerHTML = this.responseText;
          }
        }

        ajax_request.open("GET","ajax-processing.php?action=show_users");
        ajax_request.send();

      }
      function delete_user(user_id){
        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("msg").innerHTML = this.responseText;
            show_users();
          }
        }

        ajax_request.open("GET","ajax-processing.php?action=delete_user&user_id="+user_id);
        ajax_request.send();
      }
      function edit_user(user_id){
        // alert(user_id);

        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }
        

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("form").innerHTML = this.responseText;
          }
        }
        ajax_request.open("GET","ajax-processing.php?action=edit_user&user_id="+user_id);
        ajax_request.send();

      }
      function update_user(user_id){
        // alert(user_id);
        var first_name = document.getElementById("first_name").value;
            var last_name = document.getElementById("last_name").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var gender = document.getElementById("gender").value;
            // alert(gender);
            var dob = document.getElementById("date_of_birth").value;
            var image = document.getElementById("user_image").value;
            var address = document.getElementById("address").value;

        

        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("msg").innerHTML = this.responseText;
            show_users();
            cancel();
            
          }
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=update_user&user_id="+user_id+"&first_name="+first_name+"&last_name="+last_name+"&email="+email+"&password="+password+"&gender="+gender+"&date_of_birth="+dob+"&user_image="+image+"&address="+address);
        
      }
      function get_form(){


        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("form").innerHTML = this.responseText;
          }
        }
        ajax_request.open("GET","ajax-processing.php?action=get_form");
        ajax_request.send();


      }
      function search_user(){
        var search_input = document.getElementById("search_user").value;
        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("show_users").innerHTML = this.responseText;
          }
        }

        ajax_request.open("POST","ajax-processing.php",true);
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=show_users&search_input="+search_input);

      }
      function cancel(){
        document.getElementById("fname").value= "";
           document.getElementById("lname").value= "";
       document.getElementById("email").value= "";
          document.getElementById("pass").value= "";
        document.getElementById("gender").checked= "";
     document.getElementById("dob").value= "";
       document.getElementById("image").value= "";
         document.getElementById("addrs").value= "";
        
      }
      function active(user_id){
        // alert(user_id);
        var is_active = "active";
        // alert(active);

        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("msg").innerHTML = this.responseText;
            show_users();
            
            
          }
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=active&user_id="+user_id+"&is_active="+is_active);
        
      }
      function inactive(user_id){
        // alert(user_id);
        var is_active = "inactive";
        // alert(inactive);

        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("msg").innerHTML = this.responseText;
            show_users();
            
            
          }
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=inactive&user_id="+user_id+"&is_active="+is_active);
        
      }
      function approve(user_id){
        // alert(user_id);
        var is_approved = "approved";
        // alert(is_approved);

        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("msg").innerHTML = this.responseText;
            show_users();
            
            
          }
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=approve&user_id="+user_id+"&is_approved="+is_approved);
        
      }
      function reject(user_id){
        // alert(user_id);
        var is_approved = "rejected";
        // alert(is_approved);

        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("msg").innerHTML = this.responseText;
            show_users();
            
            
          }
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=reject&user_id="+user_id+"&is_approved="+is_approved);
        
      }
    </script>
  			

</div>

 
 <?php 
require_once '../admin-footer.php';
 ?>
 </div>
</div>


</body>
