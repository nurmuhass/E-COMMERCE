<?php
//Code for Header and Search Bar
function headerAndSearchCode(){
	@$defaultText = htmlentities($_GET['keywords']);

	echo '
		<header id="main_header">
			<div id="rightAlign">
	';
	//links will be here
	topRightLinks();
	echo "
			</div>
			<a href=\"index.php\"><img src=\"images/mainLogo.png\"></a>
		</header>

		<div id=\"top_search\">
			<form name=\"input\" action=\"search.php\" method=\"get\">
				<input type=\"text\" id=\"keywords\" name=\"keywords\" size=\"100\" class=\"searchBox\" value=\"$defaultText\"> &nbsp;
				<select id=category\"\" name=\"category\" class=\"searchBox\">
	";
	//include categories here
 function category (){
		 echo'	<ul style="list-style-type:disc">
		    <li>
			<a href="All Categories.php">All Categories<a/>
			<hr/>
			</li>
			</li>
			<li>
			<a href="Art.php">Art<a/>
						<hr/>
			</li>

			<li>
			<a href="Babies & Kids.php">Babies & Kids <a/>
						<hr/>
			</li>
						<li>
				<a href="Beauty & Fashion.php">Beauty & Fashion<a/>
			<hr/>
			</li>
			<li>
			    <a href="Cameras & Photo.php">Cameras & Photo  <a/>
						<hr/>
			</li>
			<li>
			<a href="Clothing & Accessories.php">Clothing & Accessories <a/>
						<hr/>
			</li>
						<li>
			<a href="Computers.php">Computers<a/>
						<hr/>
			</li>
						<li>
			  	<a href="Cellphones & Telecommunications.php">Cellphones & Telecommunications<a/>
						<hr/>
			</li>
						<li>
				<a href="Electronics Component & supply.php">Electronics Component & supply<a/>
						<hr/>
			</li>
						<li>
			<a href="Furnitures	.php">Furnitures<a/>
						<hr/>
			</li>

						<li>
			<a href="jewelry & Accessories	.php">jewelry & Accessories		<a/>
			<hr/>
			</li>
			
						<li>
							<a href="Luggage & Bags.php">Luggage & Bags<a/>
			<hr/>
			</li>
						

			<li>
			<a href="Shoes.php">Shoes	<a/>
			<hr/>
			</li>		
		<li>
			<a href="Tools & Home Improvement.php">Tools & Home Improvement	<a/>
			<hr/>
			</li>
			
					<li>
			<a href="Toys & Hobbies		.php">Toys & Hobbies		<a/>
			<hr/>
			</li>
			
						<li>
			<a href="Vehicles.php">Vehicles<a/>
						<hr/>
			</li>
						<li>
			<a href="Watches.php">Watches	<a/>
			<hr/>
			</li>
			
					<li>
			<a href="Others.php">Others<a/>
			<hr/>
			</li>
		</ul>';
		
}
     //category ();
	createCategoryList();
	echo '
				</select>
				<input type="submit" value="Search" class="button" />
			</form>
		</div>
	';
}

//Top Right Links
function topRightLinks(){
	if( !isset($_SESSION['user_id']) || empty($_SESSION['user_id']) ){
		echo '<a href="register.php">Register</a> | <a href="login.php">Log In</a>';
	
	}
	else{
		$x = $_SESSION['user_id'];
		$result = mysql_query("SELECT * FROM messages WHERE receiver=$x AND status='unread' ") or die(mysql_error());
		$num = mysql_num_rows($result);
		if($num==0){
			echo '<a href="messages_inbox.php">Messages</a> |';
		}
		else{
			echo "<span class=\"usernames\"><a href=\"messages_inbox.php\">Messages($num)</a></span> |";
		}
		echo '<a href="additem.php">Add Item</a> | <a href="account.php">My Account</a> | <a href="logout.php">Log Out</a>';
	}
}

//Creates Category <option>'s for search bar
function createCategoryList(){
	if( ctype_digit($_GET['category']) ){
		$x = $_GET['category'];
	}else{
		$x = 999;
	}
	echo "<option>All Categories</option>";
	$i = 0;
	while(1){
		if(numberToCategory($i)=="Category Does Not Exist"){
			break;
		}else{
			echo " <option value=\"$i\" ";
			if($i==$x){
				echo ' SELECTED ';
			}
			echo " >";
			echo numberToCategory($i);
			echo "</option>";
		}
		$i++;
	}
}

//Category Number to String
function numberToCategory($n){
	switch ($n) {
		case 0:
			$cat = "Art";
			break;
		case 1:
			$cat = "Babies & Kids";
			break;
		case 2:
			$cat = "Beuty & Fashion";
			break;
		case 3:
			$cat = "cameras & photo";
			break;
		case 4:
			$cat = "Clothing and Accessories";
			break;
		case 5:
			$cat = "Computers";
			break;
		case 6:
			$cat = "Cellphones & Telecommunications";
			break;
		case 7:
			$cat = "Electronics Component & supply";
			break;
		case 8:
			$cat = "Furnitures";
			break;
		case 9:
			$cat = "Jewelry & perfume";
			break;
		case 10:
			$cat = "Luggage &Bags";
			break;
		case 11:
			$cat = "Shoes";
			break;
		case 12:
			$cat = "Tools & Home Improvement";
			break;
		case 13:
			$cat = "Toys & Hobbies";
			break;
		case 14:
			$cat = "Vehicles";
			break;
		case 15:
			$cat = "Watches";
			break;
		case 16:
			$cat = "Other";
			break;
		default:
			$cat = "Category Does Not Exist";
	}

	return $cat;
}

//Code for footer
function footerCode(){
	echo '
		<footer id="main_footer">
			<table>
				<tr>
					<td><a href="https://www.youtube.com/google.com">MTC Facebook</a></td>
					<td><a href="https://www.youtube.com/google.com">MTC Instagram</a></td>
					<td><a href="https://www.youtube.com/google.com">MTC Google+</a></td>
				</tr>
			</table>
		</footer>
	';
}

//Code for accont page links
include("functions/fun_userstats.php");
function accountLinks($x){
	$my_id = $_SESSION['user_id'];
	$allPending = calculateAllPendingItems();
	$allReported = calculateAllReportedItems();
	$usersActive = calculateUsersActiveItems($my_id);
	$usersPending = calculateUsersPendingItems($my_id);
	$usersOffersReceived = calculateUsersOffersReceived($my_id);
	$usersOffersMade = calculateUsersOffersMade($my_id);
	$usersCompletedTrades = calculateUsersCompletedTrades($my_id);
	$usersUnreadMessages = calculateUsersUnreadMessages($my_id);

	switch ($x){
			case 0: $additems = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 1: $myitems = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 2: $myprofile = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 3: $shippinginfo = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 4: $offersreceived = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 5: $offersmade = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 6: $offersdeclined = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 7: $completedtrades = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 8: $inbox = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 9: $sent = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 10: $trash = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 11: $compose = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 12: $pending = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 13: $reported = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 14: $myactive = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 15: $mypending = ' style="color:white;text-shadow:1px 1px 3px black; background:url(../images/accountnav.png) 0 -26px" '; break;
			case 99: break;
		}
$result = mysql_query("SELECT * FROM users WHERE user_id=$my_id AND (role='mod' OR role='admin')");		


 //moderator tables where moderator can approve any item pending or delete any reported item.
//the moderator's table is not shown to the public but only the officials of the website.

// code for moderotor
if(mysql_num_rows($result)==1){
	echo"
	<div id=\"modnav\">
		<span class=\"\"navheadings>\">Moderator</span>
		<ul class=\"menu\">
			<li><a href=\"mod_pending.php\" $pending><span>pending $allPending</span></a></li>
	</div>
	";
	}
}
// code for user account 
	 function myaccount(){
			echo'
				<ul style="background-color:red;">
					<li>
					<h1>Moderator</h1>
							
							<a href="Pending_mod.php"><h2>Pending</h2></a>
							<a href="Reported.php"><h2>Reported</h2></a>
					</li>
				</ul>
				
				<ul>
					<li>
					<h1>Items</h1>
							<a href="Active.php"><h2>Active</h2></a>
							<a href="Pending.php"><h2>Pending</h2></a>
							<a href="Additem.php"><h2>Add item</h2></a>
					</li>
				</ul>
 
					
 <ul>
					<li>
						<h1>Messages</h1>
						<a href="Inbox.php"><h2>Inbox</h2></a>
						<a href="Sent.php"><h2>Sent</h2></a>
						<a href="Trash.php"><h2>Trash</h2></a>
						<a href="Compose.php"><h2>Compose</h2></a>
					</li>
				</ul>
				<ul>
					<li>
						<h1>My Account</h1>
						<a href="Profile.php"><h2>Profile</h2></a>
						<a href="Shipping Information.php"><h2>Shipping Information</h2></a>

					</li>
				</ul>
 
		';
		}
		
?>