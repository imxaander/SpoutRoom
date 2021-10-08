<?php
date_default_timezone_set("Asia/Manila"); 
$sname = "sql6.freemysqlhosting.net";
$uname = "sql6441996";
$pass = "TfGhZp2LeG";
$dbname = "sql6441996";

$con = mysqli_connect($sname, $uname, $pass, $dbname);

if (isset($_POST["author"]) && isset($_POST["feed_content"]) && isset($_POST["time"]) && isset($_POST["date"])) {
	$author = $_POST["author"];
	$feed_content = $_POST["feed_content"];
	$time = $_POST["time"];
	$date = $_POST["date"];

	$sql = "INSERT INTO spouts(author, feed_content, time, date) VALUES('$author', '$feed_content', '$time', '$date')";
	$result = mysqli_query($con, $sql);

	if ($result) {
		header("Location: index.php");
		exit();
	}
}
?>

<html>
<head>
	<title>SpoutRoom</title>
	<style type="text/css">
		body{
			font-family: Times New Roman;
		}
		#feeds-container{
			width: 50%;
			margin:auto;
			border-style: solid;
			padding: 20px;
			height: 80%;
			overflow-y: scroll;
		}
		.author{
			font-size: 20px;
		}
		.date{
			font-size: 13px;
		}
	</style>
</head>
<body>
		<header style="font-size: 50px;">
			<a href="">SpoutRoom.</a>
			<span style="font-size: 20px;"> "where you can spout anything. Spout it now!"</span>
			<form method="POST" action="index.php">
				<input type="text" name="author" minlength="3" maxlength="10" placeholder="Author Name..." required="true">
				<input type="text" name="feed_content" placeholder="Spout Message..." required="true">
				<input type="hidden" name="date" value="<?php echo date('m/d/Y')?>">
				<input type="hidden" name="time" value="<?php echo date('H:i A')?>">
				<input type="submit" value="Spout">
			</form>


		</header>
		<hr>
		<div id="feeds-container">
			<a href="">Refresh</a>
				<?php
				$sql = "SELECT * FROM spouts";
				$result = mysqli_query($con, $sql);

				while($row = mysqli_fetch_array($result)){?>
					<div class="feeds">
				<b class="author"><?php echo $row["author"] ?></b>
				<p class="date"><?php echo $row["date"] ?> - <span> <?php echo $row["time"] ?> </span></p>
				<p class="feed-content"><?php echo $row["feed_content"] ?></p>
				</div>
				<hr>
				<?php
				}
				?>
		</div>

</body>
<script type="text/javascript">
	var fc = document.getElementById('feeds-container');
	fc.scrollTop = fc.scrollHeight;
</script>
</html>

<?php

?>