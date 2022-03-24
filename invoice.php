<!DOCTYPE html>
<html>
    <?php
		include ("connect.php");
		session_start();
        $packageID = $_GET['packID'];
        $cusID = $_SESSION['customerID'];
        $sql = "SELECT py.cCardBank, r.reserID, r.quantity, cus.custName, p.pDesc, p.pPrice, r.customerID, p.pName, r.reserDate, py.trxnDateTime, py.trxnAmount FROM packages p INNER JOIN reservations r ON p.packageID = r.packageID INNER JOIN payments py ON r.reserID = py.reserID INNER JOIN customer cus ON r.customerID = cus.customerID INNER JOIN cart ca ON ca.customerID = cus.customerID WHERE p.packageID = '$packageID'";
		$sql_admin = "SELECT a.adminID, a.adminName, a.adminContact FROM admin a INNER JOIN packages p ON a.adminID = p.adminID";
		$data_a = $mysqli -> query($sql_admin);
		$result_a = $data_a ->fetch_assoc();
		$data = $mysqli -> query($sql);
		$result = $data -> fetch_assoc();
		$total = $result['quantity'] * $result['pPrice'];
    ?>
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		<link rel="stylesheet" href="invoice.css">
	</head>
	<body>
		<header>
			<h1>Invoice</h1>
			<address>
				<p><?php echo($result_a['adminName']);?></p>
				<p>101 E. Chapman Ave<br>Orange, CA 92866</p>
				<p><?php echo($result_a['adminContact'])?></p>
			</address>
			<span><img alt="" src="http://www.jonathantneal.com/examples/invoice/logo.png"><input type="file" accept="image/*"></span>
		</header>
		<article>
			<h1>Recipient</h1>
			<address>
				<p><?php echo($result['custName']);?></p>
			</address>
			<table class="meta">
				<tr>
					<th><span >Invoice #</span></th>
					<td><span ><?php echo($result['reserID']);?></span></td>
				</tr>
				<tr>
					<th><span>Date</span></th>
					<td><span><?php echo($result['reserDate']);?></span></td>
				</tr>
				<tr>
					<th><span>Amount Paid</span></th>
					<td><span id="prefix">RM</span><span><?php echo($total);?></span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span>Package Name</span></th>
						<th><span>Description</span></th>
						<th><span>Package Price</span></th>
						<th><span>Quantity</span></th>
						<th><span>Total</span></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						
						<td><span><?php echo($result['pName']);?></span></td>
						<td><span><?php echo($result['pDesc']);?></span></td>
						<td><span>RM</span><span ><?php echo($result['pPrice']);?></span></td>
						<td><span><?php echo($result['quantity']);?></span></td>
						<td><span>RM</span><span><?php echo($total)?></span></td>
					</tr>
				</tbody>
			</table>

			<table class="balance">
				<tr>
					<th><span>Bank</span></th>
					<td><span></span><span><?php echo($result['cCardBank'])?></span></td>
				</tr>
				<tr>
					<th><span>Total</span></th>
					<td><span>RM</span><span ><?php echo($total)?></span></td>
				</tr>
				<tr>
					<th><span>Amount Paid</span></th>
					<td><span>RM</span><span><?php echo($total)?></span></td>
				</tr>
			</table>
		</article>
		<aside>
			<h1><span>Additional Notes</span></h1>
			<div>
				<p><?php echo($result['pDesc'])?></p>
			</div>
		</aside>
	</body>
</html>