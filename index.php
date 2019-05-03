<!-- CSCI311 | Names: Tiffany & Ning | Final Project -->
<?php
	require_once("./private/dbinfo.inc");
	session_start();
	$_SESSION['url'] = $_SERVER['REQUEST_URI'];
	$err;
	$myHandle;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<meta charset="UTF-8" />
	<title>BOOK Home</title>
	<link rel="stylesheet" type="text/css" href="./Home/css/homeStyles.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div id="main">
	<header>
		<div class="viuLogo"><a><img id="viuLogo" src="./Home/media/viu-logo.png" alt="viu Logo"/></a></div>
	    <h1 class="head"><b>BOOK BUY/SELL/TRADE</b></h1>
<?php
if(!isset($_SESSION['UserData']['userid'])){
	echo "<div class=\"login\"><ul class=\"login\"><li class=\"login\"><a href=\"./login/login.php\">Login</a></li></ul></div>";
}else{
	echo "<div class=\"login\"><ul class=\"login\"><li class=\"login\"><a href=\"./Profile/myBooks.php\">Profile</a></li></ul></div>";
	echo "<div class=\"login\"><ul class=\"login\"><li class=\"login\"><a href=\"./login/logout.php\">Logout</a></li></ul></div>";
}
?>
	</header>

    <div class="myNavBar">
     	<ul class="myNav">
			<li class="pagelink"><a href="./Buybook/Buybook.php">Buy Books</a></li>
      		<li class="pagelink"><a href="./Sellbook/Sellbook.php">Sell Books</a></li>
      		<li class="pagelink"><a href="./Tradebook/Tradebook.php">Trade Books</a></li>
		</ul>  	
    </div>

    <h1 class="subhead">TEXT BOOKS</h1>
    <div class="Books">
      <div class="row">
        <div class="column"><a><img class="newNew" style="width: 50px; height: 50px;" src="./Home/media/New.gif" alt=""></a></div>
		<?php
			try{
				$myHandle = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
			}catch(PDOException $e){
				$err .= "Connection failed \n";
			}if($myHandle){
				$myText = "select Photo, Title from Books where Type = 'Text' and Sold_Time = '0000-00-00' order by Post_Time desc;";
				$rsltText = $myHandle->query($myText);
				$i = 1;
				$Textbooks;
				foreach($rsltText as $row){
					foreach($row as $field=>$value){
						$Textbooks[$i][$field] = $value;
					}
					$i++;
				}
				$numBooks = sizeof($Textbooks);
				for($m=1; $m<=8; $m++){
					echo "<div class='column'>\n";
					echo "<a href='#' title='".htmlspecialchars($Textbooks[$m]['Title'])."'>
						  <img class='open' src='".htmlspecialchars($Textbooks[$m]['Photo'])."' alt='".htmlspecialchars($Textbooks[$m]['Title'])."'>
						  </a></div>\n";
				}
			}
			$myHandle = null;
		?>
        <div class="more"><a href="./Buybook/Buybook.php">More</a></div>        
      </div>
    </div>
    <h1 class="subhead">GENERAL BOOKS</h1>
    <div class="Books">
      <div class="row">
		<div class="column"><a><img class="newNew" style="width: 50px; height: 50px;" src="./Home/media/New.gif" alt=""></a></div>
		<?php
			try{
				$myHandle = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
			}catch(PDOException $e){
				$err .= "Connection failed \n";
			}if($myHandle){
				$myBook = "select Photo, Title from Books where Type = 'Book' and Sold_Time = '0000-00-00' order by Post_Time desc;";
				//echo $myBook;
				$rsltBook = $myHandle->query($myBook);
				$i = 1;
				$books;
				foreach($rsltBook as $row){
					foreach($row as $field=>$value){
						$books[$i][$field] = $value;
					}
					$i++;
				}
				$numBooks = sizeof($books);
				for($m=1; $m<=8; $m++){
					echo "<div class='column'>\n";
					echo "<a href='#'  title='".htmlspecialchars($books[$m]['Title'])."'>
						  <img class='open' src='".htmlspecialchars($books[$m]['Photo'])."' alt='".htmlspecialchars($books[$m]['Title'])."'>
						  </a></div>\n";
				}
			}
			$myHandle = null;
		?>
        <div class="more"><a href="./Buybook/Buybook.php">More</a></div>
      </div>
    </div>
</div>
<!-- ************* POPUP ***************** -->
<!--Creates the popup body-->
<div class="popup-overlay">
  <!--Creates the popup content-->
	<div class="popup-content">
		<h2 class="titleArea"></h2>
		<p><p class="insertionArea"></p>
		<!--popup's close button-->
		<div class="closeButton"><button class="close">Close</button></div>    
	</div>
</div>
	<footer><small> Tiffany & Ning Copyright &copy; 2019 </small></footer>	
<!-- ************* JQUERY ***************** -->
<pre><code>
<script>
	//When image is selected display the popup and wrap the image into the popup, displaying the alt text at the title
	$(".open").on("click", function(){
	  $(".popup-overlay, .popup-content").addClass("active");
		$('.insertionArea').wrap(this);
		var titles = $("img.open").attr("alt");
		$(".titleArea").text(titles);		
	});
	//When close is pressed re-hide the popup and unwrap the currently selected image
	$(".close, .popup-overlay").on("click", function(){
		$('.insertionArea').unwrap("img.open");
	  $(".popup-overlay, .popup-content").removeClass("active");
	});
</script>
</code></pre>
</body>
</html>
