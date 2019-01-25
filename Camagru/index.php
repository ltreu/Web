<?PHP session_start();
	ini_set('display_errors',0);
  ?>

<!DOCTYPE html>
<html>
<head>
<style>
@import url('https://fonts.googleapis.com/css?family=Merienda+One');
@import url('https://fonts.googleapis.com/css?family=Open+Sans');

</style>
<link rel="stylesheet" type="text/css" href="css/global.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" type="text/css" href="css/index.css">
<meta name="google" content="notranslate" />
<title>Home - Camagru</title>
</head>


<body>
  <?php
	$current_page = "Home";
  include "header.php";
	echo $_SESSION['Login'];
  ?>
  <div class="center">

  <!-- <p class="text">Welcome to Camagru.</p><br/> -->
    <br/>
    <h1>Welcome to Camagru</h1>
    <br/>
<p class="text">Inspired by the people, and built for the people.
This is a website dedicated to overlaying fixtures over photographs.</p>
<p class="text">Now that’s what I call stupid: In my junior year of high school, this guy asked me on a date.</p>
<p class="text"> He rented a Redbox movie and made a pizza. </p>
<p class="text"> We were watching the movie and the oven beeped so the pizza was done.</p> 
<p class="text"> He looked me dead in the eye and said, “This is the worst part.” </p>
<p class="text"> I then watched this boy open the oven and pull the pizza out with his bare hands, rack and all,</p> 
<p class="text">screaming at the top of his lungs. We never had a second date.</p>
<p class="text">This block of text is just a test</p>
<br/><br/>
<br/><br/>
<br/><br/>
<h3> Epic Funny Stories from Happy Camagru users</h3>
<br/>
<!-- <p class="text">This block of text is just a test</p></div> -->
<p class="text"> The fake report card: I failed the first quarter of a class in middle school, </p>
<p class="text">so I made a fake report card. I did this every quarter that year. </p>
<p class="text">  I forgot that they mail home the end-of-year cards, and my mom got it before I could intercept with my fake. </p>
<p class="text">She was PISSED—at the school for their error. </p>
<p class="text">The teacher also retired that year and had already thrown out his records,</p> 
<p class="text">so they had to take my mother’s “proof” (the fake ones I made throughout the year) and “correct” the “mistake.” </p>
<p class="text">  I’ve never told her the truth.</p></div>
<br/><br/>
<p class="text"> The fake report card: I failed the first quarter of a class in middle school, </p>
<p class="text">  I’ve never told her the truth.</p></div>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
</body>
<?php
include 'footer.php';
 ?>
</html>
