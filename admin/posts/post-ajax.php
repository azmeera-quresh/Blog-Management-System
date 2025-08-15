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
  <div><button onclick="get_form()" class="btn btn-primary mt-3">Add post</button></div>
      <div id="form"> 
        
      </div>
      <hr style="border:1px solid white">
      <div id="show_posts">
      </div>
    </center>
    <script>

      // get_form();
      show_posts();
      function add_post(){
        /*alert("hi")*/
            var blog_id = document.getElementById("blog_id").value;
            var category_id = document.getElementById("category_id").value;
            var post_title = document.getElementById("post_title").value;
            var post_summary = document.getElementById("post_summary").value;
            var post_description = document.getElementById("post_description").value;
            var featured_image = document.getElementById("featured_image").value;
            // alert(gender);
            
            



        /*alert(blog_id)
        alert(post_title)
        alert(post_summary)
        alert(post_description)
        alert(featured_image)
        alert(post_status)
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
        ajax_request.send("action=add_post&blog_id="+blog_id+"&post_title="+post_title+"&post_summary="+post_summary+"&post_description="+post_description+"&featured_image="+featured_image+"&category_id="+category_id);

        

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            // alert(this.responseText);
            document.getElementById("msg").innerHTML=this.responseText;
            show_posts();
            cancel();
          }
        }
      }
      function show_posts(){

        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("show_posts").innerHTML = this.responseText;
          }
        }

        ajax_request.open("GET","ajax-processing.php?action=show_posts");
        ajax_request.send();

      }
      function add_post_attachment(){
        /*alert("hi")*/

            var post_attachment_title = document.getElementById("post_attachment_title").value;
            var post_attachment_path = document.getElementById("post_attachment_path").value;
            // var is_active = document.getElementById("is_active").value;
           



        /*alert(post_id)
        alert(post_attachment_title)
        alert(post_attachment_path)
        alert(is_active)
        
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
        ajax_request.send("action=add_post_attachment&post_attachment_title="+post_attachment_title+"&post_attachment_path="+post_attachment_path);

        

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            // alert(this.responseText);
            document.getElementById("msg").innerHTML=this.responseText;
            
          }
        }
      }
      function delete_post(post_id){
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
            show_posts();
          }
        }

        ajax_request.open("GET","ajax-processing.php?action=delete_post&post_id="+post_id);
        ajax_request.send();
      }
      function edit_post(post_id){
        // alert(post_id);

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
        ajax_request.open("GET","ajax-processing.php?action=edit_post&post_id="+post_id);
        ajax_request.send();

      }
      function update_post(post_id){
        // alert(post_id);
        var blog_id = document.getElementById("blog_id").value;
            var post_title = document.getElementById("post_title").value;
            var post_summary = document.getElementById("post_summary").value;
            var post_description = document.getElementById("post_description").value;
            var featured_image = document.getElementById("featured_image").value;
            var post_status = document.getElementById("post_status").value;
            var is_comment_allowed = document.getElementById("is_comment_allowed").value;

        

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
            show_posts();
            cancel();
            
          }
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=update_post&post_id="+post_id+"&blog_id="+blog_id+"&post_title="+post_title+"&post_summary="+post_summary+"&post_description="+post_description+"&featured_image="+featured_image+"&post_status="+post_status+"&is_comment_allowed="+is_comment_allowed);
        
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
      function get_attachment_form(){

        
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
        ajax_request.open("GET","ajax-processing.php?action=get_attachment_form");
        ajax_request.send();


      }
      function search_post(){
        var search_input = document.getElementById("search_post").value;
        var ajax_request = null;
        if(window.XMLHttpRequest){
          ajax_request = new XMLHttpRequest();
        }
        else{
          ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajax_request.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("show_posts").innerHTML = this.responseText;
          }
        }

        ajax_request.open("POST","ajax-processing.php",true);
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=show_posts&search_input="+search_input);

      }
      function cancel(){
        document.getElementById("blog_id").value = "";
     document.getElementById("post_title").value = "";
       document.getElementById("post_summary").value = "";
           document.getElementById("post_description").value = "";
         document.getElementById("featured_image").value = "";
      document.getElementById("post_status").value = "";
            document.getElementById("is_comment_allowed").value = "";

        
        
      }
      function active(post_id){
        // alert(post_id);
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
            show_posts();
            
            
          }
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=active&post_id="+post_id+"&is_active="+is_active);
        
      }
      function inactive(post_id){
        // alert(post_id);
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
            show_posts();
            
            
          }
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=inactive&post_id="+post_id+"&is_active="+is_active);
        
      }
      function approve(post_id){
        // alert(post_id);
        var is_approved = "allow";
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
            show_posts();
            
            
          }
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=approve&post_id="+post_id+"&is_approved="+is_approved);
        
      }
      function reject(post_id){
        // alert(post_id);
        var is_approved = "not allow";
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
            show_posts();
            
            
          }
        }

        ajax_request.open("POST","ajax-processing.php");
        ajax_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
        ajax_request.send("action=reject&post_id="+post_id+"&is_approved="+is_approved);
        
      }
    </script>
  			

</div>

 
 <?php 
require_once '../admin-footer.php';
 ?>
 </div>
</div>


</body>
