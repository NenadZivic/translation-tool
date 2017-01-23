<?php

require_once '../src/DB.php';

$email = $_REQUEST['email'];
$example_id = $_REQUEST['example_id'];

if (!empty($email)) {

	if (empty($example_id)) $example_id = 1;

	$db = new DB();
	$example = $db->getExample($example_id);

	if (empty($example)) {
		$example_id = 1;
		$example = $db->getExample($example_id);
	}
	
	$translation = $db->getTranslation($email, $example_id);

	if (empty($translation)) {
		$translation = [
			'translation' => '',
			'comment' => ''
		];	
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Translation Tool</title>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>
	<body>

			<?php if (empty($email)) { ?>
				<form id="signInForm">
					<div class="form-group">
						<label>Email address</label>
						<input type="email" class="form-control" name="email" placeholder="Email">
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			<?php } else { ?>
				<div id="mainContent">
					<div id="exampleNumber" class="content">
						<form id="page" class="form-inline">
							<label>Example Number: </label>
							<input type="number" class="form-control" name="example_id" value="<?php echo $example_id; ?>">
							<input type="hidden"  name="email" value="<?php echo $email; ?>">
							<button type="submit" class="btn btn-default">Go</button>
						</form>
					</div>
					<div style="clear: both;"></div>
					<div id="leftContent" class="content">
						<form>
							<div class="form-group">
								<label>Source Text</label>
								<input type="text" class="form-control" disabled value="<?php echo $example['source']; ?>">
								<label>Image</label>
								<img src="images/img_<?php echo $example['id']; ?>.jpg" alt="img"></img>
							</div>
						</form>
					</div>
					<div id="rightContent" class="content">
						<form action="save.php" method="post">
							<div class="form-group">
								<input type="hidden" name="email" value="<?php echo $email; ?>">
								<input type="hidden" name="example_id" value="<?php echo $example_id; ?>">
								<label>Target Text *</label>
								<input type="text" class="form-control" name="translation" value="<?php echo $translation['translation']; ?>">
								<label>Additional Comments (optinal)</label>
								<textarea class="form-control" rows="3" name="comment"><?php echo $translation['comment']; ?></textarea>
								<div class="form-group buttons">
										<button type="submit" name="prev" class="btn btn-default">Previous</button>
										<button type="submit" class="btn btn-primary">Next</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			<?php } ?>

		<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="scripts.js"></script>

		<script type="text/javascript">

		</script>
	</body>
</html>
