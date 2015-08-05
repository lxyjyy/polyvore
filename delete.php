
<?php
        require 'database.php';
        $id = 0;

        if ( !empty($_GET['id'])) {
                $id = $_REQUEST['id'];
        }

        if ( !empty($_POST)) {
                // keep track post values
                $id = $_POST['id'];
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//Delete image file
                $sql = "SELECT fileName FROM product WHERE id = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($id));
		foreach ($q as $row) {
			unlink( $row['fileName'] );
		}
		//Delete sql data
                $sql = "DELETE FROM product WHERE id = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($id));
                Database::disconnect();
                header("Location: manage.php");
        }
?>
<!DOCTYPE html>
<html lang="zh-tw">
<?php include '_head.php';?>
<body>
    <div class="container">
	<div class="col-lg-8 col-lg-offset-2">
		<div class="row">
			<h3>Delete a Product</h3>
		</div>
		<form class="form-horizontal" action="delete.php" method="post">
	 		<input type="hidden" name="id" value="<?php echo $id;?>"/>
			<div class="alert alert-danger">Are you sure to delete ?</div>
			<div class="form-actions">
				  <button type="submit" class="btn btn-danger">Yes</button>
				  <a class="btn btn-default" href="manage.php">No</a>
			</div>
		</form>
	</div>
    </div> <!-- /container -->
 </body>
</html>
