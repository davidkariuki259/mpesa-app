<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">My M-Pesa</h1>

        <p class="lead">-----------------</p>

        <form method="get">
  <div class="form-group">
    <label for="phonenumber">Phone Number</label>
    <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="254712345678">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>

    <div class="body-content">
        <?php print_r($response); ?>
    </div>

</div>
