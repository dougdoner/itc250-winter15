<?php
/**
 * itc 250
 * lab3.php
 * Author: Douglas Doner
 * Date: 1/27/15
 */


/**
 * demo_postback_nohtml.php is a single page web application that allows us to request and view
 * a customer's name
 *
 * This version uses no HTML directly so we can code collapse more efficiently
 *
 * This page is a model on which to demonstrate fundamentals of single page, postback
 * web applications.
 *
 * Any number of additional steps or processes can be added by adding keywords to the switch
 * statement and identifying a hidden form field in the previous step's form:
 *
 *<code>
 * <input type="hidden" name="act" value="next" />
 *</code>
 *
 * The above live of code shows the parameter "act" being loaded with the value "next" which would be the
 * unique identifier for the next step of a multi-step process
 *
 * @package ITC281
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 1.1 2011/10/11
 * @link http://www.newmanix.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @todo finish instruction sheet
 * @todo add more complicated checkbox & radio button examples
 */

# '../' works for a sub-folder.  use './' for the root
require '/var/www/html/wn15/inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials

/*
$config->metaDescription = 'Web Database ITC281 class website.'; #Fills <meta> tags.
$config->metaKeywords = 'SCCC,Seattle Central,ITC281,database,mysql,php';
$config->metaRobots = 'no index, no follow';
$config->loadhead = ''; #load page specific JS
$config->banner = ''; #goes inside header
$config->copyright = ''; #goes inside footer
$config->sidebar1 = ''; #goes inside left side of page
$config->sidebar2 = ''; #goes inside right side of page
$config->nav1["page.php"] = "New Page!"; #add a new page to end of nav1 (viewable this page only)!!
$config->nav1 = array("page.php"=>"New Page!") + $config->nav1; #add a new page to beginning of nav1 (viewable this page only)!!
*/

//END CONFIG AREA ----------------------------------------------------------

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

switch ($myAction)
{//check 'act' for type of process
    case "display": # 2)Display all ball players stored in the session array
        showName();
        break;
    case "clear": # 3)Clear all ballplayers
        clearPlayers();
        break;
    default: # 1)Ask user to enter in a player
        showForm();
}

function showForm()
{# shows form so user can enter their name.  Initial scenario
    get_header(); #defaults to header_inc.php

    echo
        '<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>
	<script type="text/javascript">
		function checkForm(thisForm)
		{//check form data for valid info
			if(empty(thisForm.YourName,"Please Enter Your Name")){return false;}
			return true;//if all is passed, submit!
		}
	</script>
	<h3 align="center">' . smartTitle() . '</h3>
	<p align="center">Please enter your name</p>
	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">
		<table align="center">
			<tr>
				<td align="right">
					Name
				</td>
				<td>
					<input type="text" name="name" /><font color="red"><b>*</b></font> <em>(alphabetic only)</em>
				</td>
			</tr>
<tr>		<tr>
				<td align="right">
					Team
				</td>
				<td>
					<input type="text" name="team" /><font color="red"><b>*</b></font> <em>(alphabetic only)</em>
				</td>
			<tr>
				<td align="right">
					Touchdowns
				</td>
				<td>
					<input type="text" name="touchDowns" /><font color="red"><b>*</b></font> <em>(alphabetic only)</em>
				</td>
			</tr>
			<tr>
				<td align="right">
					Games
				</td>
				<td>
					<input type="text" name="games" /><font color="red"><b>*</b></font> <em>(alphabetic only)</em>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2">
					<input type="submit" value="Submit"><em>(<font color="red"><b>*</b> required field</font>)</em>
				</td>
			</tr>
		</table>
		<input type="hidden" name="act" value="display" />
	</form>
	';
    get_footer(); #defaults to footer_inc.php
}

function showName()
{#form submits here we show entered name
    get_header(); #defaults to footer_inc.php
    /* if(!isset($_POST['YourName']) || $_POST['YourName'] == '')
    {//data must be sent
        feedback("No form data submitted"); #will feedback to submitting page via session variable
        myRedirect(THIS_PAGE);
    }

    if(!ctype_alnum($_POST['YourName']))
    {//data must be alphanumeric only
        feedback("Only letters and numbers are allowed.  Please re-enter your name."); #will feedback to submitting page via session variable
        myRedirect(THIS_PAGE);
    } */

    /*
    $name = $_POST["name"];
    $team = $_POST["team"];
    $touchDowns = (int)$_POST["touchdowns"];
    */

    $name = $_POST["name"];
    $team = $_POST["team"];
    $touchDowns = $_POST["touchDowns"];
    $games = $_POST["games"];

    //starts a session
    //session_start();

    if (!isset($_SESSION))
    {
        session_start();
    }

    if (!isset($_SESSION["ballPlayers"]))
    {//if session var not set, create new variable
        $_SESSION["ballPlayers"] = array();
    }
    else
    {// for weird cases

    }

    $_SESSION["ballPlayers"][] = new BallPlayer($name, $team, $touchDowns, $games);

    foreach ($_SESSION["ballPlayers"] as $players)
    {
        echo $players . "<br />";
    }

    echo '<p> <a href="' . THIS_PAGE . '">Add more players</a>';
    echo '<p> <a href="' . THIS_PAGE . '?act=clear">Clear all players</a>';
    die;
}

function clearPlayers()
{
    unset($_SESSION["ballPlayers"]);

    echo "<p>Players unset!</p>";

    showForm();
}

class BallPlayer
{

    public $team = "";
    public $name = "";
    public $touchdowns = 0;
    public $games = 0;

    //when a new BallPlayer object is instantiated, default values are assigned to the object properties
    function __construct($name, $team, $touchdowns, $games)
    {
        $this->name = $name;
        $this->team = $team;
        $this->touchdowns = $touchdowns;
        $this->games = $games;
    }//end constructor

    //if a BallPlayer object is echo'd without referring to a property of the object, this magic method is called and in this case an echo statement is called
    function __toString()
    {
        $myReturn = '';
        $myReturn .= 'name: ' . $this->name;
        $myReturn .= ' team: ' . $this->team;
        $myReturn .= ' touchdowns: ' . $this->touchdowns;
        $myReturn .= ' games: ' . $this->games;
        $myReturn .= ' average touchdowns per game: ' . $this->averageTouchDowns($this->touchdowns, $this->games);
        return $myReturn;
    }//end __toString

    function averageTouchDowns($touchdowns, $games)
    {
        return $touchdowns / $games;
    }
}//end BallPlayer

?>
