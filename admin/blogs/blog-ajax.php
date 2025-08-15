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
  <div><button onclick="get_form()" class="btn btn-primary mt-3">Add Blog</button></div>
      <div id="form"> 
        
      </div>
      <hr style="border:1px solid white">
      <div id="show_blogs">
      </div>
    </center>
    <script>

      // get_form();
      show_blogs();
      function add_blog(){
        /*alert("hi")*/

        var user_id = 1;
            var blog_title = document.getElementById("blog_title").value;
            var post_per_page = document.getElementById("post_per_page").value;
            var blog_background_image = document.getElementById("blog_background_image").value;
            var blog_status = document.getElementById("blog_status").value;
            



        /*alert(user_id)
        alert(blog_title)
        alert(post_per_page)
        alert(blog_background_image)
        alert(blog_status)
        alert(is_comment_allowed)
        */

        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=add_blog&user_id="+user_id+"&blog_title="+blog_title+"&post_per_page="+post_per_page+"&blog_background_image="+blog_background_image+"&blog_status="+blog_status);

        

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            // alert(this.responseText);
            document.getElementById("msg").innerHTML=this.responseText;
            show_blogs();
            cancel();
          }
        }
      }
      function show_blogs(){

        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("show_blogs").innerHTML = this.responseText;
          }
        }

        ajax_request.open("GET","ajax-processing.php?action=show_blogs");
        ajax_request.send();

      }
      function delete_blog(blog_id){
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
            show_blogs();
          }
        }

        ajax_request.open("GET","ajax-processing.php?action=delete_blog&blog_id="+blog_id);
        ajax_request.send();
      }
      function edit_blog(blog_id){
        // alert(blog_id);

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
        ajax_request.open("GET","ajax-processing.php?action=edit_blog&blog_id="+blog_id);
        ajax_request.send();

      }
      function update_blog(blog_id){
        // alert(blog_id);

        var user_id = 1;
            var blog_title = document.getElementById("blog_title").value;
            var post_per_page = document.getElementById("post_per_page").value;
            var blog_background_image = document.getElementById("blog_background_image").value;
            var blog_status = document.getElementById("blog_status").value;

        

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
            show_blogs();
            cancel();
            
          }
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=update_blog&blog_id="+blog_id+"&user_id="+user_id+"&blog_title="+blog_title+"&post_per_page="+post_per_page+"&blog_background_image="+blog_background_image+"&blog_status="+blog_status);
        
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
      function search_blog(){
        var search_input = document.getElementById("search_blog").value;
        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("show_blogs").innerHTML = this.responseText;
          }
        }

        ajax_request.open("POST","ajax-processing.php",true);
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=show_blogs&search_input="+search_input);

      }
      function cancel(){
        document.getElementById("blog_id").value = "";
     document.getElementById("user_id").value = "";
       document.getElementById("blog_title").value = "";
           document.getElementById("post_per_page").value = "";
         document.getElementById("blog_background_image").value = "";
      document.getElementById("blog_status").value = "";

    // <!-- blog_id  user_id  blog_title  post_per_page  blog_background_image  blog_status           created_at  updated_at   -->
        
        
      }
      function active(blog_id){
        // alert(blog_id);
        var is_active = "Active";
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
            show_blogs();
            
            
          }
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=active&blog_id="+blog_id+"&is_active="+is_active);
        
      }
      function inactive(blog_id){
        // alert(blog_id);
        var is_active = "InActive";
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
            show_blogs();
            
            
          }
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=inactive&blog_id="+blog_id+"&is_active="+is_active);
        
      }
      
    </script>
  			

</div>

 
 <?php 
require_once '../admin-footer.php';
 ?>
 </div>
</div>


</body>
