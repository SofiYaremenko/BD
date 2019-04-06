<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="adminstyle.css">
<link rel="stylesheet" href="ajaxStyle.css">

</head>
<body>

<div class="topnav"><a class="hover">ExplorUAm</a>
  <a href="excursions.php">Excursions</a>
  <a href="clients.php">Clients</a>
  <a href="places.php">Places</a>
  <a href="orders.php">Orders</a>
  <a href="carriers.php">Carriers</a>
  <a href="guides.php">Guides</a>
  <a class="active" href="managers.php">Managers</a>
  <a href="order_excursions.php">Order excursions</a>
</div>

<div class="sidenav">
  <a href="#about">Add New</a>
</div>

<div class="main">
   <div class="wrapper">
    <?php echo $comments; ?>
    <form class="comment_form">
      <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
      </div>
      <div>
        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment" cols="30" rows="5"></textarea>
      </div>
      <button type="button" id="submit_btn">POST</button>
      <button type="button" id="update_btn" style="display: none;">UPDATE</button>
    </form>
  </div>

</div>

</body>
</html>

<script src="jquery-3.3.1.min"></script>
<script src="scripts.js"></script>