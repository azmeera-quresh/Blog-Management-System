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
  <div><button onclick="get_form()" class="btn btn-primary mt-3">Add Category</button></div>
      <div id="form"> 
        
      </div>
      <hr style="border:1px solid white">
      <div id="show_categorys">
      </div>
    </center>
    <script>

      // get_form();
      show_categorys();
      function add_category(){
        /*alert("hi")*/
            var category_title = document.getElementById("category_title").value;
            var category_description = document.getElementById("category_description").value;
            var category_status = document.getElementById("category_status").value;
            



        // alert(category_title)
        // alert(category_description)
        // alert(category_status)
        

        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=add_category&category_title="+category_title+"&category_description="+category_description+"&category_status="+category_status);

        

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            // alert(this.responseText);
            document.getElementById("msg").innerHTML=this.responseText;
            show_categorys();
            cancel();
          }
        }
      }
      function show_categorys(){

        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("show_categorys").innerHTML = this.responseText;
          }
        }

        ajax_request.open("GET","ajax-processing.php?action=show_categorys");
        ajax_request.send();

      }
      function delete_category(category_id){
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
            show_categorys();
          }
        }

        ajax_request.open("GET","ajax-processing.php?action=delete_category&category_id="+category_id);
        ajax_request.send();
      }
      function edit_category(category_id){
        // alert(category_id);

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
        ajax_request.open("GET","ajax-processing.php?action=edit_category&category_id="+category_id);
        ajax_request.send();

      }
      function update_category(category_id){
        // alert(category_id);

            var category_title = document.getElementById("category_title").value;
            var category_description = document.getElementById("category_description").value;
            var category_status = document.getElementById("category_status").value;

        

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
            show_categorys();
            cancel();
            
          }
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=update_category&category_id="+category_id+"&category_title="+category_title+"&category_description="+category_description+"&category_status="+category_status);
        
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
      function search_category(){
        var search_input = document.getElementById("search_category").value;
        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("show_categorys").innerHTML = this.responseText;
          }
        }

        ajax_request.open("POST","ajax-processing.php",true);
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=show_categorys&search_input="+search_input);

      }
      function cancel(){
     document.getElementById("category_title").value = "";
           document.getElementById("category_description").value = "";
      document.getElementById("category_status").value = "";


        
        
      }
      function active(category_id){
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
           show_categorys();
          }
        }

        ajax_request.open("GET","ajax-processing.php?action=active_category&category_id="+category_id);
        ajax_request.send();
        
      }
      function inactive(category_id){
        
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
            show_categorys();
            
            
          }
        }

        ajax_request.open("GET","ajax-processing.php?action=inactive_category&category_id="+category_id);
        ajax_request.send();
        
      }
      
    </script>
  			

</div>

 
 <?php 
require_once '../admin-footer.php';
 ?>
 </div>
</div>


</body>
