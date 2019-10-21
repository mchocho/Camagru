<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Camagru</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- Use inline css -->
	    <style>
.row {
  display: flex;
  flex-wrap: wrap;
  padding: 0 4px;
}

/* Create four equal columns that sits next to each other */
.column {
  flex: 25%;
  max-width: 25%;
  padding: 0 4px;
}

.column img {
  margin-top: 8px;
  vertical-align: middle;
  width: 100%;
}

/* Responsive layout - makes a two column-layout instead of four columns */
@media screen and (max-width: 800px) {
  .column {
    flex: 50%;
    max-width: 50%;
  }
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    flex: 100%;
    max-width: 100%;
  }
}
</style>
	    <!-- Or link external file -->
        <!-- <link rel="stylesheet" href="css/style.css" media="all" /> -->
	</head>
	<body>
		<!-- Content goes here -->
<div class="image_container">
<div class="row">
  <div class="column">
    <img src="images/wedding.jpg">
    <img src="images/rocks.jpg">
    <img src="images/falls2.jpg">
    <img src="images/paris.jpg">
    <img src="images/nature.jpg">
    <img src="images/mist.jpg">
    <img src="images/paris.jpg">
  </div>
  <div class="column">
    <img src="images/underwater.jpg">
    <img src="images/ocean.jpg">
    <img src="images/wedding.jpg">
    <img src="images/mountainskies.jpg">
    <img src="images/rocks.jpg">
    <img src="images/underwater.jpg">
  </div>
  <div class="column">
    <img src="images/wedding.jpg">
    <img src="images/rocks.jpg">
    <img src="images/falls2.jpg">
    <img src="images/paris.jpg">
    <img src="images/nature.jpg">
    <img src="images/mist.jpg">
    <img src="images/paris.jpg">
  </div>
  <div class="column">
    <img src="images/underwater.jpg">
    <img src="images/ocean.jpg">
    <img src="images/wedding.jpg">
    <img src="images/mountainskies.jpg">
    <img src="images/rocks.jpg">
    <img src="images/underwater.jpg">
  </div>
</div>
</div>
	</body>
</html>
