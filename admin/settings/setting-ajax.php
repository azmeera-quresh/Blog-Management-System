<head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>setting management</title>
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
      <div id="form"> 
        
      </div>
      <hr style="border:1px solid white">
      <div id="show_settings">
      </div>
    </center>
    <script>

      // get_form();
      show_settings();
      
      function show_settings(){

        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("show_settings").innerHTML = this.responseText;
          }
        }

        ajax_request.open("GET","ajax-processing.php?action=show_settings");
        ajax_request.send();

      }
      function delete_setting(setting_id){
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
            show_settings();
          }
        }

        ajax_request.open("GET","ajax-processing.php?action=delete_setting&setting_id="+setting_id);
        ajax_request.send();
      }
      function edit_setting(setting_id){
        // alert(setting_id);

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
        ajax_request.open("GET","ajax-processing.php?action=edit_setting&setting_id="+setting_id);
        ajax_request.send();

      }
      function update_setting(setting_id){
        // alert(setting_id);

        var user_id = document.getElementById("user_id").value;
            var post_id = document.getElementById("post_id").value;
            var setting = document.getElementById("setting").value;
            var setting_status = document.getElementById("setting_status").value;

        

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
            show_settings();
            cancel();
            
          }
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=update_setting&setting_id="+setting_id+"&user_id="+user_id+"&post_id="+post_id+"&setting="+setting+"&setting_status="+setting_status);
        
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
      function search_setting(){
        var search_input = document.getElementById("search_setting").value;
        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("show_settings").innerHTML = this.responseText;
          }
        }

        ajax_request.open("POST","ajax-processing.php",true);
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=show_settings&search_input="+search_input);

      }
      function cancel(){
        document.getElementById("user_id").value = "";
     document.getElementById("post_id").value = "";
     document.getElementById("setting").value = "";
      document.getElementById("setting_status").value = "";
      }
      
      function active(setting_id){
        // alert(setting_id);
        var setting_status = "Active";
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
            show_settings();
            
            
          }
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=active&setting_id="+setting_id+"&setting_status="+setting_status);
        
      }
      function inactive(setting_id){
        // alert(setting_id);
        var setting_status = "InActive";
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
            show_settings();
            
            
          }
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=inactive&setting_id="+setting_id+"&setting_status="+setting_status);
        
      }
      
    </script>
  			

</div>

 
 <?php 
require_once '../admin-footer.php';
 ?>
 </div>
</div>


</body>
