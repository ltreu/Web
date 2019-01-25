<h2>Fixtures</h2><br/>

<!-- <p class="text">Testing to follow orders</p> -->
<!-- <p class="text">Just a test line of text</p><br/> -->
<?PHP	if ($_SESSION['nb_fixtures'] != 0)
{
    echo $_SESSION['nb_fixtures'];
	echo '<p class="text" style="text-align:center;"><a href="fixtures-users.php';
	echo '?login='.$_SESSION['login'];
	echo '"> See all my fixtures</a></p><br/><br/>';
}
?>
<div id="camera-and-filters">
	<div id="camera" ondrop="drop(event)" ondragover="allowDrop(event)">
		<canvas id="canva_filters" width="400px" height="300px"></canvas>
		<video id="video" width="400px" height="300px" autoplay="true"></video>
		<canvas id="canvas" width="400px" height="300px"></canvas>
		<img src="../../img/empty.png" style="width:100%;">

	</div>

</div>
	<br/>
	<div id="side">
		<img src="../../img/arrow-up.png" id='arrow-up' onclick='to_top()'/>
		<div id="filters">
			<?php
			include '../../functions/filters.php';

			$data = get_filters();
			foreach ($data as $filter)
			{
				echo "<img src='../../".$filter['path_filter']."' class='hidden_path' id='".$filter['id_filter']."'/>";
			}
			for ($i = 0; $i < 5; $i++)
			{
				echo "<div class='filter' style='display:block;'>";
				echo "<img src='' class='image_filter' draggable='true' ondragstart='drag(event)' id=''/>";
				echo "</div>";
			}
			?>

		</div>
		<img src="../../img/arrow-down.png" id='arrow-down' onclick='to_bot()'/>

	</div>

	<div id="move">
		<br/>
		<img src="../../img/plus.png" onclick='do_plus()'/>
		<img src="../../img/minus.png" onclick="do_less()"/>
		<img src="../../img/left.png" onclick="do_left()"/>
		<img src="../../img/right.png" onclick="do_right()"/>
		<img src="../../img/up.png" onclick="do_top()"/>
		<img src="../../img/down.png" onclick="do_bot()"/>
		<img src="../../img/reset.png" onclick="do_reset()"/>
		<br/>
	</div>
<br/>
<div id="buttons">
	<?php
	if ($_SESSION['print_file_uploaded'])
	{
		echo "<button id='reset'>Place the camera</button>";
	}
	else {
		echo "<button id='reset'>Reset the Camera</button>";
	}
	?>
	<button id="snap">Take the picture</button>
	<button id="save">Save Picture</button>
	<form method="post" accept-charset="utf-8" name="form1">
		<input name="hidden_data" id="hidden_data" type="hidden"/>
		<input name="hidden_data2" id="hidden_data2" type="hidden"/>
	</form>

</div>

<br/><br/>

<p class='text'>Would you prefer to upload an image ?</p>
<form method="post" action="reception.php" enctype="multipart/form-data">
	<p class='text'>File (Format png uniquement, 2 Mb max) :</p><br />
	<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
	<input type="file" name="image" id="image" /><br />
	<input type="submit" name="submit" value="Submit" />
</form>
	<?php
	include '../../errors.php';
	send_image_error();
	if ($_SESSION['print_file_uploaded'])
	{
		echo $_SESSION['print_file_uploaded'];
		$_SESSION['print_file_uploaded'] = NULL;
	}

	?>

		<script src="filter-effects.js"></script>
		<script src="drag-and-drop.js"></script>
		<script src="modify-filters.js"></script>
		<script src="camera_handle.js"></script>


	<br/><br/>
<div class="gallery" id="photos"></div>

