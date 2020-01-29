<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Blank</title>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet"> -->
<link href="css/fontGoogle.css" rel="stylesheet">
<link href="css/css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<script src="js/jquery-1.7.2.min.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
<style>
	div.mainPage{
		min-height: 600px;
	}
	td{
		padding-left: 3px;
	}
	td.mid{
		padding-left: 0px;
		text-align: center;
	}
	.layer1{
		border-collapse: separate; 
		width: 100%;
		height: 700px;
	}
	.tree{
		border:1px solid black;
		border-radius: 5px;
		vertical-align: top;
		width:15%;
	}
	iframe{
		width:100%;
		border: 0;
		height: 30vw;
	}
	#catatan{
		width: 98%;
		resize: vertical;
	}
	li:hover{
		cursor: pointer;
	}
</style>
</head>
<body>
<?php include "header_tran.php" ?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12 mainPage">
					<?php
						if(isset($_GET['patno'])){
							$patno = $_GET['patno'];
						}
						if(isset($_GET['caseno'])){
							$caseno = $_GET['caseno'];
						}
					?>

					<table class="layer1">
						<tr>
							<td class="tree">
								<?php
									include "koneksi.php";
									date_default_timezone_set("Asia/Bangkok");

									$queCase = "select distinct case_no from T_Case where Pat_No = ".$patno."order by Case_No desc";
									// echo $queCase;
									$queCase_exe = sqlsrv_query($conn,$queCase);

									echo "<ul>";
									while($cases = sqlsrv_fetch_array($queCase_exe, SQLSRV_FETCH_ASSOC)){
										echo "
											<li ondblclick=\"getNotes('".$patno."','".$cases['case_no']."');\">".$cases['case_no']."</li>
										";
									}
									echo "</ul>"
								?>
							</td>
							<td style="padding-left: 10px;vertical-align: top;">

								<form method="post" action="saveNotes.php" target="tableNotes">
									<button type="submit" class="btn" id="save" name="save">Save</button>
									<button type="button" class="btn" id="clear" name="clear">Clear</button>
									<button type="button" class="btn" id="close" name="close" onclick="back2case();">Close</button>

									<input type="hidden" name="hidUser" value="<?php echo $_SESSION["username"]; ?>" />
									<input type="hidden" name="hidPatno" value="<?php echo $patno; ?>" />
									<input type="hidden" name="hidCaseno" id="hidCaseno" value="<?php echo $caseno; ?>" />
									</br></br>
									<table>
										<tr>
											<td>User ID : </td>
											<td><?php echo $_SESSION["username"]; ?></td>
										</tr>
									</table>

									<textarea id="catatan" name="catatan" rows="9" maxlength="250">
S/
O/ TD :      HR :      RR:      S:
Conjunctiva :
Thorax : 		 Cor :
Abdomen :
Edema :
A/ CKD on HD
P/ HD jam        ; QB        ;UFG        ;Th/
									</textarea>

									</br>
									<iframe id="tableNotes" name="tableNotes" src="NotesTable.php?patno=<?php echo $patno; ?>&caseno=<?php echo $caseno; ?>"></iframe>
								</form>

							</td>
						</tr>
					</table>
					<?php include "EditNotes.php"; ?>

				</div>
				<!-- /span12 -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /main-inner -->
</div>
<!-- /main -->
<?php include "footer.html"; ?>

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>

	function getNotes(patno, caseno){
		document.getElementById('tableNotes').contentDocument.write("<style>h3{font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;}</style><h3>Please Wait . . .</h3>");
		document.getElementById('tableNotes').src = 'NotesTable.php?patno='+patno+'&caseno='+caseno;
	}

	function clr(){
		document.getElementById("catatan").value = "";
	}

	function back2case(){
		window.location.href = "T_Case.php?case="+document.getElementById('hidCaseno').value;
	}

	function openEdit(cell){
		var frm = document.getElementById('tableNotes');
		var dst = document.getElementById('editNote');
		document.getElementById('hidId').value = cell;
		modal.style.display = "block";
		var content = frm.contentWindow.document.getElementById(cell).innerHTML;
		dst.value = content.trim();
	}
</script>

<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script src="js/base.js"></script>

</body>
</html>
