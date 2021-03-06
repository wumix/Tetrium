<?php
// <editor-fold defaultstate="collapsed" desc="get_val Function: Get values from mysql">
function get_val($village_id)
{

    $result = mysql_query("SELECT * FROM map WHERE village_id='$village_id'");
    while ($row = mysql_fetch_assoc($result)) {
        $woodcutter1 = $row["woodcutter1"];
        $woodcutter2 = $row["woodcutter2"];
        $woodcutter3 = $row["woodcutter3"];
        $woodcutter4 = $row["woodcutter4"];

        $claypit1 = $row["claypit1"];
        $claypit2 = $row["claypit2"];
        $claypit3 = $row["claypit3"];
        $claypit4 = $row["claypit4"];

        $ironmine1 = $row["ironmine1"];
        $ironmine2 = $row["ironmine2"];
        $ironmine3 = $row["ironmine3"];
        $ironmine4 = $row["ironmine4"];

        $cropland1 = $row["cropland1"];
        $cropland2 = $row["cropland2"];
        $cropland3 = $row["cropland3"];
        $cropland4 = $row["cropland4"];
        $cropland5 = $row["cropland5"];
        $cropland6 = $row["cropland6"];

        $mainbuilding = $row["mainbuilding"];
        $storage = $row["storage"];
        $barracks = $row["barracks"];
        $marketplace = $row["marketplace"];
        $stable = $row["stable"];
        $wall = $row["wall"];

        //resources in database
        $wood = $row["wood"];
        $clay = $row["clay"];
        $iron = $row["iron"];
        $wheat = $row["wheat"];

        $tsold = $row["timestamp"];

        $villagenamei = $row["village"];
        $villagexi = $row["x"];
        $villageyi = $row["y"];

        $clubswinger = $row["clubswinger"];
        $spearman = $row["spearman"];
        $axeman = $row["axeman"];

        $scouthorse = $row["scouthorse"];
        $knighthorse = $row["knighthorse"];
        $warhorse = $row["warhorse"];

        $vid = $row["village_id"];//For debug log only
        $player = $row["player"];//For debug log only
        $player_id = $row["id"];//For debug log only


    }

    return array("<font color=red>General</font>" => "-------",
        "tsold" => $tsold, "player_id" => $player_id, "player" => $player, "village_id" => $vid, "villagenamei" => $villagenamei, "villagexi" => $villagexi, "villageyi" => $villageyi, "<font color=red>Troops</font>" => "--------", "clubswinger" => $clubswinger,
        "spearman" => $spearman, "axeman" => $axeman, "scouthorse" => $scouthorse, "knighthorse" => $knighthorse,"warhorse" => $warhorse, "<font color=red>Fields</font>" => "--------", "woodcutter1" => $woodcutter1, "woodcutter2" => $woodcutter2, "woodcutter3" => $woodcutter3, "woodcutter4" => $woodcutter4,
        "claypit1" => $claypit1, "claypit2" => $claypit2, "claypit3" => $claypit3, "claypit4" => $claypit4, "ironmine1" => $ironmine1,
        "ironmine2" => $ironmine2, "ironmine3" => $ironmine3, "ironmine4" => $ironmine4, "cropland1" => $cropland1, "cropland2" => $cropland2,
        "cropland3" => $cropland3, "cropland4" => $cropland4, "cropland5" => $cropland5, "cropland6" => $cropland6, "<font color=red>Buildings</font>" => "--------",
        "mainbuilding" => $mainbuilding, "storage" => $storage, "barracks" => $barracks, "marketplace" => $marketplace, "stable" => $stable,
        "wall" => $wall, "<font color=red>Resources</font>" => "------", "wood" => $wood, "clay" => $clay, "iron" => $iron, "wheat" => $wheat);
}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="res_calc Function: Calculate resources">
function res_calc($village_id)
{
    $mysql_data = get_val($village_id);
    //Calculate how much storage space the player has
    $storagespace = $mysql_data["storage"] * 3200 + 800;

//calculate production in a hour
    $croplandsh = ceil((pow($mysql_data["cropland1"] + 6, 3 + $mysql_data["cropland1"] / 320) / 4) + (pow($mysql_data["cropland2"] + 6, 3 + $mysql_data["cropland2"] / 320) / 4) + (pow($mysql_data["cropland3"] + 6, 3 + $mysql_data["cropland3"] / 320) / 4) + (pow($mysql_data["cropland4"] + 6, 3 + $mysql_data["cropland4"] / 320) / 4) + (pow($mysql_data["cropland5"] + 6, 3 + $mysql_data["cropland5"] / 320) / 4) + (pow($mysql_data["cropland6"] + 6, 3 + $mysql_data["cropland6"] / 320) / 4));
    $woodcuttersh = ceil((pow($mysql_data["woodcutter1"] + 6, 3 + $mysql_data["woodcutter1"] / 320) / 4) + (pow($mysql_data["woodcutter2"] + 6, 3 + $mysql_data["woodcutter2"] / 320) / 4) + (pow($mysql_data["woodcutter3"] + 6, 3 + $mysql_data["woodcutter3"] / 320) / 4) + (pow($mysql_data["woodcutter4"] + 6, 3 + $mysql_data["woodcutter4"] / 320) / 4));
    $claypitsh = ceil((pow($mysql_data["claypit1"] + 6, 3 + $mysql_data["claypit1"] / 320) / 4) + (pow($mysql_data["claypit2"] + 6, 3 + $mysql_data["claypit2"] / 320) / 4) + (pow($mysql_data["claypit3"] + 6, 3 + $mysql_data["claypit3"] / 320) / 4) + (pow($mysql_data["claypit4"] + 6, 3 + $mysql_data["claypit4"] / 320) / 4));
    $ironminesh = ceil((pow($mysql_data["ironmine1"] + 6, 3 + $mysql_data["ironmine1"] / 320) / 4) + (pow($mysql_data["ironmine2"] + 6, 3 + $mysql_data["ironmine2"] / 320) / 4) + (pow($mysql_data["ironmine3"] + 6, 3 + $mysql_data["ironmine3"] / 320) / 4) + (pow($mysql_data["ironmine4"] + 6, 3 + $mysql_data["ironmine4"] / 320) / 4));


//TROOP WHEAT USAGE|| The file has other places where this is changed
    $croplandsh = $croplandsh - $mysql_data["clubswinger"] - $mysql_data["spearman"] - $mysql_data["axeman"] - $mysql_data["scouthorse"] - $mysql_data["knighthorse"] - $mysql_data["warhorse"];

//change all timestamps to seconds
    $timedifference = strtotime(date("Y-m-d H:i:s")) - $mysql_data["tsold"];

//Calculate how much the user has resources now
    $newwood = $timedifference * ($woodcuttersh / 3600) + $mysql_data["wood"];
    $newclay = $timedifference * ($claypitsh / 3600) + $mysql_data["clay"];
    $newiron = $timedifference * ($ironminesh / 3600) + $mysql_data["iron"];
    $newwheat = $timedifference * ($croplandsh / 3600) + $mysql_data["wheat"];

//check if the production overlaps the storage
    if ($newwood > $storagespace) {
        $newwood = $storagespace;
    }
    if ($newclay > $storagespace) {
        $newclay = $storagespace;
    }
    if ($newiron > $storagespace) {
        $newiron = $storagespace;
    }
    if ($newwheat > $storagespace) {
        $newwheat = $storagespace;
    }

//Kill troops if $newwheat<0
    if ($newwheat <= 0 and ($mysql_data["clubswinger"] > 0 or $mysql_data["spearman"] > 0 or $mysql_data["axeman"] > 0
                         or $mysql_data["scouthorse"] > 0 or $mysql_data["knighthorse"] > 0 or $mysql_data["warhorse"] > 0)) {

        $troop_kill_amount = ceil(($newwheat / 10) * -1);
        $troop_amount = $mysql_data["clubswinger"] + $mysql_data["spearman"] + $mysql_data["axeman"] + $mysql_data["scouthorse"] + $mysql_data["knighthorse"] + $mysql_data["warhorse"] > 0;


        if($troop_amount > $troop_kill_amount){
            $croplandsh = $croplandsh + $troop_kill_amount;
                if ($mysql_data["clubswinger"] > 0) {
                    if ($troop_kill_amount < $mysql_data["clubswinger"]) {
                        $clubswinger_no_wheat = $mysql_data["clubswinger"] - $troop_kill_amount;
                        $newwheat = $newwheat + $troop_kill_amount * 10;
                        $troop_kill_amount = 0;
                    } else {
                        $temp = $troop_kill_amount;
                        $troop_kill_amount = $troop_kill_amount - $mysql_data["clubswinger"];
                        $clubswinger_no_wheat = $mysql_data["clubswinger"] - $temp;
                    }
                }
                if($troop_kill_amount > 0) {
                    if ($mysql_data["spearman"] > 0) {
                        if ($troop_kill_amount < $mysql_data["spearman"]) {
                            $spearman_no_wheat = $mysql_data["spearman"] - $troop_kill_amount;
                            $newwheat = $newwheat + $troop_kill_amount * 10;
                            $troop_kill_amount = 0;
                        } else {
                            $temp = $troop_kill_amount;
                            $troop_kill_amount = $troop_kill_amount - $mysql_data["spearman"];
                            $spearman_no_wheat = $mysql_data["spearman"] - $temp;
                        }
                    }
                }else{
                    $spearman_no_wheat = $mysql_data["spearman"];
                }
                if($troop_kill_amount > 0) {
                    if ($mysql_data["axeman"] > 0) {
                        if ($troop_kill_amount < $mysql_data["axeman"]) {
                            $axeman_no_wheat = $mysql_data["axeman"] - $troop_kill_amount;
                            $newwheat = $newwheat + $troop_kill_amount * 10;
                            $troop_kill_amount = 0;
                        } else {
                            $temp = $troop_kill_amount;
                            $troop_kill_amount = $troop_kill_amount - $mysql_data["axeman"];
                            $axeman_no_wheat = $mysql_data["axeman"] - $temp;
                        }
                    }
                }else{
                    $axeman_no_wheat = $mysql_data["axeman"];
                }





            if ($mysql_data["scouthorse"] > 0) {
                if ($troop_kill_amount < $mysql_data["scouthorse"]) {
                    $scouthorse_no_wheat = $mysql_data["scouthorse"] - $troop_kill_amount;
                    $newwheat = $newwheat + $troop_kill_amount * 10;
                    $troop_kill_amount = 0;
                } else {
                    $temp = $troop_kill_amount;
                    $troop_kill_amount = $troop_kill_amount - $mysql_data["scouthorse"];
                    $scouthorse_no_wheat = $mysql_data["scouthorse"] - $temp;
                }
            }
            if($troop_kill_amount > 0) {
                if ($mysql_data["knighthorse"] > 0) {
                    if ($troop_kill_amount < $mysql_data["knighthorse"]) {
                        $knighthorse_no_wheat = $mysql_data["knighthorse"] - $troop_kill_amount;
                        $newwheat = $newwheat + $troop_kill_amount * 10;
                        $troop_kill_amount = 0;
                    } else {
                        $temp = $troop_kill_amount;
                        $troop_kill_amount = $troop_kill_amount - $mysql_data["knighthorse"];
                        $knighthorse_no_wheat = $mysql_data["knighthorse"] - $temp;
                    }
                }
            }else{
                $knighthorse_no_wheat = $mysql_data["knighthorse"];
            }
            if($troop_kill_amount > 0) {
                if ($mysql_data["warhorse"] > 0) {
                    if ($troop_kill_amount < $mysql_data["warhorse"]) {
                        $warhorse_no_wheat = $mysql_data["warhorse"] - $troop_kill_amount;
                        $newwheat = $newwheat + $troop_kill_amount * 10;
                        $troop_kill_amount = 0;
                    } else {
                        $temp = $troop_kill_amount;
                        $troop_kill_amount = $troop_kill_amount - $mysql_data["warhorse"];
                        $warhorse_no_wheat = $mysql_data["warhorse"] - $temp;
                    }
                }
            }else{
                $warhorse_no_wheat = $mysql_data["warhorse"];
            }




            $troops = array("clubswinger" => $clubswinger_no_wheat, "spearman" => $spearman_no_wheat, "axeman" => $axeman_no_wheat,
                            "scouthorse" => $scouthorse_no_wheat, "knighthorse" => $knighthorse_no_wheat, "warhorse" => $warhorse_no_wheat);
        }else{
            $troops = array("clubswinger" => 0, "spearman" => 0, "axeman" => 0, "scouthorse" => 0, "knighthorse" => 0, "warhorse" => 0);
            $croplandsh = $croplandsh + $troop_kill_amount;
            $newwheat = 0;
        }

        set_array_db($troops, "map", $village_id);
    }

    $res = array("wood" => $newwood, "clay" => $newclay, "iron" => $newiron, "wheat" => $newwheat);
    set_array_db($res, "map", $village_id);

    send_timestamp($village_id);
    return array("wood" => $woodcuttersh,"clay" => $claypitsh,"iron" => $ironminesh,"wheat" => $croplandsh);
}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="set_array_db Function: Send array of data to mysql">
function set_array_db($array, $table, $village_id)
{
    foreach ($array as $field => $value) {
        mysql_query("UPDATE $table SET $field='$value' WHERE village_id='$village_id'") or die(mysql_error());
    }
}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="send_timestamp Function: Send timestamp to mysql">
function send_timestamp($village_id)
{
    $dbnewtime = strtotime(date("Y-m-d H:i:s"));
    mysql_query("UPDATE map SET timestamp='$dbnewtime' WHERE village_id='$village_id'") or die(mysql_error());
}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="new_event Function: Send array data to event mysql">
function new_event($array)
{
    $fields = array_keys($array);
    $values = array_values($array);

    $i = 0;
    $par1 = "";
    $par2 = "";
    foreach ($fields as $f_text) {
        if ($i == 0) {
            $par1 .= "`" . $f_text . "`";
        } else {
            $par1 .= ",`" . $f_text . "`";
        }
        $i = 1;
    }
    $i = 0;
    foreach ($values as $v_text) {
        if ($i == 0) {
            $par2 .= "'" . $v_text . "'";
        } else {
            $par2 .= ",'" . $v_text . "'";
        }
        $i = 1;
    }
    $query = "INSERT INTO `events` (" . $par1 . ") VALUES (" . $par2 . ")";
    mysql_query($query) or die(mysql_error());
}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="train Function: Train troops">
function train($type, $amount, $village_id, $player_id)
{

    if (empty($type) or empty($amount)) {
        header("location:../tetrium.php?p=ugg&building=barracks");
        exit;
    }
    if ($amount <= 0) {
        header("location:../tetrium.php?p=ugg&building=barracks");
        exit;
    }

    $mysql_data = get_val($village_id);

    if (($mysql_data["barracks"] < 1 and $type == "clubswinger") or ($mysql_data["barracks"] < 5 and $type == "axeman") or ($mysql_data["barracks"] < 10 and $type == "axeman")
        or ($mysql_data["stable"] < 1 and $type == "scouthorse") or ($mysql_data["stable"] < 5 and $type == "knighthorse") or ($mysql_data["stable"] < 10 and $type == "warhorse")) {
        return "level";
    }

    $upgrade_changeling_var = 0;
    $upgrade_count = mysql_query("SELECT * FROM events WHERE type='troops' AND village_id='$village_id'");
    $upgrade_many = mysql_num_rows($upgrade_count);

    if ($upgrade_many > 0) {
        while ($row = mysql_fetch_array($upgrade_count)) {
            $upgrade_changeling_var = $upgrade_changeling_var + 1;
            $now = strtotime("now");
            $completed = $row['completed'];
            $completed_stamp = strtotime($completed);
            $seconds_left = $completed_stamp - $now;
            $upgrade_all_seconds_left[$upgrade_changeling_var] = $seconds_left;
        }
        $upgrade_all_seconds_left = array_slice($upgrade_all_seconds_left, -1, 1);
    } else {
        $upgrade_all_seconds_left = 0;
    }


    /*
     * BARRACKS
     * */
    if ($type == "clubswinger") {
        $woodreq = 20 * $amount;
        $clayreq = 0 * $amount;
        $ironreq = 10 * $amount;
        $wheatreq = 10 * $amount;
        $timereq = 10 * $amount;
    }
    if ($type == "spearman") {
        $woodreq = 10 * $amount;
        $clayreq = 10 * $amount;
        $ironreq = 30 * $amount;
        $wheatreq = 10 * $amount;
        $timereq = 15 * $amount;
    }
    if ($type == "axeman") {
        $woodreq = 10 * $amount;
        $clayreq = 10 * $amount;
        $ironreq = 20 * $amount;
        $wheatreq = 10 * $amount;
        $timereq = 20 * $amount;
    }


    /*
     * STABLE
     * */
    if ($type == "scouthorse") {
        $woodreq = 60 * $amount;
        $clayreq = 50 * $amount;
        $ironreq = 30 * $amount;
        $wheatreq = 30 * $amount;
        $timereq = 30 * $amount;
    }
    if ($type == "knighthorse") {
        $woodreq = 90 * $amount;
        $clayreq = 80 * $amount;
        $ironreq = 150 * $amount;
        $wheatreq = 50 * $amount;
        $timereq = 40 * $amount;
    }
    if ($type == "warhorse") {
        $woodreq = 120 * $amount;
        $clayreq = 120 * $amount;
        $ironreq = 200 * $amount;
        $wheatreq = 100 * $amount;
        $timereq = 50 * $amount;
    }



    if ($mysql_data["wood"] < $woodreq or $mysql_data["clay"] < $clayreq or $mysql_data["iron"] < $ironreq or $mysql_data["wheat"] < $wheatreq) {
        return "resources";
    }
    $newwood = $mysql_data["wood"] - $woodreq;
    $newclay = $mysql_data["clay"] - $clayreq;
    $newiron = $mysql_data["iron"] - $ironreq;
    $newwheat = $mysql_data["wheat"] - $wheatreq;


    $timereq = $timereq + $upgrade_all_seconds_left[0];
    $completed = date("Y-m-d H:i:s", strtotime("$timereq seconds"));


    $res = array("wood" => $newwood, "clay" => $newclay, "iron" => $newiron, "wheat" => $newwheat);
    set_array_db($res, "map", $village_id);

    $arr = array("type" => "troops", "completed" => $completed, "troop_type" => $type, "amount" => $amount, "userid" => $player_id, "village_id" => $village_id);

    new_event($arr);

    if($type == "scouthorse" or $type == "knighthorse" or $type == "warhorse"){
        $building = "stable";
    }else{
        $building = "barracks";
    }
    header("location: ../tetrium.php?p=ugg&building=".$building."&message=Success!");
    exit;
}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="upgrade Function: Upgrade building">
function upgrade($building, $village_id, $player_id)
{

    if (empty($building)) {
        header("location:tetrium.php?p=res");
        exit;
    }

    $mysql_data = get_val($village_id);

    switch ($building) {
        case "woodcutter1":
            $level = $mysql_data["woodcutter1"];
            $name = "Woodcutter";
            break;
        case "woodcutter2":
            $level = $mysql_data["woodcutter2"];
            $name = "Woodcutter";
            break;
        case "woodcutter3":
            $level = $mysql_data["woodcutter3"];
            $name = "Woodcutter";
            break;
        case "woodcutter4":
            $level = $mysql_data["woodcutter4"];
            $name = "Woodcutter";
            break;
        case "claypit1":
            $level = $mysql_data["claypit1"];
            $name = "Claypit";
            break;
        case "claypit2":
            $level = $mysql_data["claypit2"];
            $name = "Claypit";
            break;
        case "claypit3":
            $level = $mysql_data["claypit3"];
            $name = "Claypit";
            break;
        case "claypit4":
            $level = $mysql_data["claypit4"];
            $name = "Claypit";
            break;
        case "ironmine1":
            $level = $mysql_data["ironmine1"];
            $name = "Ironmine";
            break;
        case "ironmine2":
            $level = $mysql_data["ironmine2"];
            $name = "Ironmine";
            break;
        case "ironmine3":
            $level = $mysql_data["ironmine3"];
            $name = "Ironmine";
            break;
        case "ironmine4":
            $level = $mysql_data["ironmine4"];
            $name = "Ironmine";
            break;
        case "cropland1":
            $level = $mysql_data["cropland1"];
            $name = "Cropland";
            break;
        case "cropland2":
            $level = $mysql_data["cropland2"];
            $name = "Cropland";
            break;
        case "cropland3":
            $level = $mysql_data["cropland3"];
            $name = "Cropland";
            break;
        case "cropland4":
            $level = $mysql_data["cropland4"];
            $name = "Cropland";
            break;
        case "cropland5":
            $level = $mysql_data["cropland5"];
            $name = "Cropland";
            break;
        case "cropland6":
            $level = $mysql_data["cropland6"];
            $name = "Cropland";
            break;
        case "mainbuilding":
            $level = $mysql_data["mainbuilding"];
            $name = "Main Building";
            break;
        case "storage":
            $level = $mysql_data["storage"];
            $name = "Storage";
            break;
        case "barracks":
            $level = $mysql_data["barracks"];
            $name = "Barracks";
            if ($mysql_data["mainbuilding"] < 5 and $level == 0) {
                header("location:../tetrium.php?p=ugg&message=error cant build&building=", $building);
                exit;
            }
            break;
        case "marketplace":
            $level = $mysql_data["marketplace"];
            $name = "Marketplace";
            if ($mysql_data["mainbuilding"] < 7 or $mysql_data["storage"] < 5 and $level == 0) {
                header("location:../tetrium.php?p=ugg&message=error cant build&building=", $building);
                exit;
            }
            break;
        case "stable":
            $level = $mysql_data["stable"];
            $name = "Stable";
            if ($mysql_data["mainbuilding"] < 7 or $mysql_data["barracks"] < 5 and $level == 0) {
                header("location:../tetrium.php?p=ugg&message=error cant build&building=", $building);
                exit;
            }
            break;
        case "wall":
            $level = $mysql_data["wall"];
            $name = "Wall";
            if ($mysql_data["mainbuilding"] < 5 and $level == 0) {
                header("location:../tetrium.php?p=ugg&message=error cant build&building=", $building);
                exit;
            }
            break;
        default:
            echo "error";
            unset($_GET["building"]);
            exit;
            break;
    }


    $upgrade_count = mysql_query("SELECT * FROM events WHERE village_id='$village_id' AND building='$building'");
    $upgrade_count = mysql_num_rows($upgrade_count);
    if ($upgrade_count >= 1) {

//CHECK THE BIGGEST LEVEL FROM EVENTS IF BUILDING
        $upgrade_events_mysql_level = mysql_query("SELECT nextlevel FROM events WHERE building='$building' AND village_id='$village_id' ORDER BY nextlevel");
        while ($row = mysql_fetch_array($upgrade_events_mysql_level)) {
            $eventlevel = $row['nextlevel'];
        }
        $newlevel = $eventlevel + 1;
    } else {
        $newlevel = $level + 1;
    }

    $upgrade_changeling_var = 0;

    $upgrade_count = mysql_query("SELECT * FROM events WHERE village_id='$village_id' AND type='building'");
    $upgrade_many = mysql_num_rows($upgrade_count);
    if ($upgrade_many > 0) {
        while ($row = mysql_fetch_array($upgrade_count)) {
            $upgrade_changeling_var = $upgrade_changeling_var + 1;
            $now = strtotime("now");
            $completed = $row['completed'];
            $completed_stamp = strtotime($completed);
            $seconds_left = $completed_stamp - $now;
            $upgrade_all_seconds_left[$upgrade_changeling_var] = $seconds_left;
        }
        $upgrade_all_seconds_left = array_slice($upgrade_all_seconds_left, -1, 1);
    } else {
        $upgrade_all_seconds_left = 0;
    }

//Production building upgrade cost
    if ($name == "Woodcutter" or $name == "Claypit" or $name == "Ironmine" or $name == "Cropland") {
        $woodreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40));
        $clayreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40));
        $ironreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40));
        $wheatreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40));
        $timereq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.95);

        if ($name == "Woodcutter") {
            $woodreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.8);
        }
        if ($name == "Claypit") {
            $clayreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.8);
        }
        if ($name == "Ironmine") {
            $ironreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.8);
        }
        if ($name == "Cropland") {
            $wheatreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.8);
        }
    }

    if ($name == "Main Building") {
        $woodreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.7);
        $clayreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.8);
        $ironreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.5);
        $wheatreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.7);
        $timereq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 4.2);
    }
    if ($name == "Barracks") {
        $woodreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 1.1);
        $clayreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 1.1);
        $ironreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.8);
        $wheatreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.6);
        $timereq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 3.1);
    }
    if ($name == "Storage") {
        $woodreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.8);
        $clayreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.8);
        $ironreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.7);
        $wheatreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.4);
        $timereq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 2.6);
    }
    if ($name == "Marketplace") {
        $woodreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.9);
        $clayreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.9);
        $ironreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 1.15);
        $wheatreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.65);
        $timereq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 3.1);
    }
    if ($name == "Stable") {
        $woodreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 2);
        $clayreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 1.6);
        $ironreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 1.45);
        $wheatreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 2);
        $timereq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 2.8);
    }
    if ($name == "Wall") {
        $woodreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 1.55);
        $clayreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 2);
        $ironreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 2);
        $wheatreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 1.2);
        $timereq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 3.2);
    }


    $timereq = $timereq + $upgrade_all_seconds_left[0];
    $completed = date("Y-m-d H:i:s", strtotime("$timereq seconds"));

    if ($mysql_data["wood"] > $woodreq and $mysql_data["clay"] > $clayreq and $mysql_data["iron"] > $ironreq and $mysql_data["wheat"] > $wheatreq) {
        $newwood = $mysql_data["wood"] - $woodreq;
        $newclay = $mysql_data["clay"] - $clayreq;
        $newiron = $mysql_data["iron"] - $ironreq;
        $newwheat = $mysql_data["wheat"] - $wheatreq;

        $res = array("wood" => $newwood, "clay" => $newclay, "iron" => $newiron, "wheat" => $newwheat);
        set_array_db($res, "map", $village_id);

        $arr = array("type" => "building", "completed" => $completed, "building" => $building, "nextlevel" => $newlevel, "userid" => $player_id, "village_id" => $village_id);
        new_event($arr);


        header("location:../tetrium.php?p=res");
        exit;

    } elseif ($status == 0) {
        header("location:../tetrium.php?p=ugg&building=$building&message=Not enough resources");
        exit;
    } elseif ($status == 1) {
        header("location:../tetrium.php?p=ugg&building=$building&message=The builders are busy with another building");
        exit;
    }
}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="switch_village Function: Switch village">
function switch_village($village_id, $player_id)
{

    $villages = list_villages($player_id);

    if (in_array($village_id, $villages)) {
        $_SESSION["current_village_id"] = $village_id;
    } else {
        header("location:../tetrium.php?p=res&message=you do not own a village with that id :(");
        exit;
    }
    header("location:../tetrium.php?p=res");
    exit;
}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="list_villages Function: List All player villages">
function list_villages($player_id)
{
    $all_user_villages_ids = array();
    $x = 0;
    $result = mysql_query("SELECT village_id FROM map WHERE id='$player_id'");

    $all_user_villages_amount = mysql_num_rows($result);
    while ($row = mysql_fetch_array($result)) {
        $all_user_villages_ids[$x] = $row["village_id"];
        $x = $x + 1;
    }
    $x = NULL;
    return $all_user_villages_ids;
}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="attack Function: Attack a village">
function attack($from_village_id, $target_village_id, $troops, $player_id)
{


    $mysql_data = get_val($from_village_id);

    if (empty($troops["clubswinger"])) {
        $troops["clubswinger"] = 0;
    }
    if (empty($troops["spearman"])) {
        $troops["spearman"] = 0;
    }
    if (empty($troops["axeman"])) {
        $troops["axeman"] = 0;
    }
    if (empty($troops["scouthorse"])) {
        $troops["scouthorse"] = 0;
    }
    if (empty($troops["knighthorse"])) {
        $troops["knighthorse"] = 0;
    }
    if (empty($troops["warhorse"])) {
        $troops["warhorse"] = 0;
    }


    if ($troops["clubswinger"] < 0 or $troops["spearman"] < 0 or $troops["axeman"] < 0 or $troops["scouthorse"] < 0 or $troops["knighthorse"] < 0 or $troops["warhorse"] < 0) {
        header("location: ../tetrium.php?p=att&message=attack: only numbers over -1");
        exit;
    }


    if (empty($target_village_id)) {
        header("location: ../tetrium.php?p=att&message=send resources: please fill out the destination");
        exit;
    }

    if ($mysql_data["clubswinger"] < $troops["clubswinger"] or $mysql_data["spearman"] < $troops["spearman"] or $mysql_data["axeman"] < $troops["axeman"] or
        $mysql_data["scouthorse"] < $troops["scouthorse"] or $mysql_data["knighthorse"] < $troops["knighthorse"] or $mysql_data["warhorse"] < $troops["warhorse"]) {
        header("location: ../tetrium.php?p=att&message=attack: not enough troops");
        exit;
    }

    $result = mysql_query("SELECT * FROM map WHERE village_id='$from_village_id' and id='$player_id'") or die(mysql_error());
    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_assoc($result)) {
            $from_village_x = $row["x"];
            $from_village_y = $row["y"];
        }
    } else {
        header("location: ../tetrium.php?p=att&message=send resources: you can't attack from another players village XD");
        exit;
    }
    if ($target_village_id == $from_village_id) {
        header("location: ../tetrium.php?p=att&message=you can't attack the village you are sending troops from");
        exit;
    }


    /*
    GET RECEIVING VILLAGE DETAILS $X,$Y,$VILLAGE ID USING MAINLY CORDINATES
    */

    if (isset($target_village_id)) {
        $result = mysql_query("SELECT * FROM map where village_id='$target_village_id'") or die(mysql_error());
        if (mysql_num_rows($result) > 0) {
            while ($info = mysql_fetch_array($result)) {
                $target_village_id = $info["village_id"];
                $x = $info["x"];
                $y = $info["y"];
                $target_id = $info["id"];
            }
        } else {
            header("location: ../tetrium.php?p=att&message=send resources: no such village exists");
            exit;
        }
    }

    /*
    END GET RECEIVING VILLAGE DETAILS
    */

    $x_distance = abs($from_village_x - $x); //absolute value
    $y_distance = abs($from_village_y - $y); //absolute value

    if ($troops["scouthorse"] > 0) {
        $speed = 10;
    }
    if ($troops["knighthorse"] > 0) {
        $speed = 8;
    }
    if ($troops["warhorse"] > 0) {
        $speed = 6;
    }
    if ($troops["spearman"] > 0) {
        $speed = 4;
    }
    if ($troops["axeman"] > 0 or $troops["clubswinger"] > 0) {
        $speed = 3;
    }


    $time = round((sqrt(pow($x_distance, 2) + pow($y_distance, 2)) / $speed) * 60);//Time in minutes
    $time_return = $time * 2;//Time in minutes

    $completed = date("Y-m-d H:i:s", strtotime("$time minutes"));
    $return_completed = date("Y-m-d H:i:s", strtotime("$time_return minutes"));

    $new_clubswinger = $mysql_data["clubswinger"] - $troops["clubswinger"];
    $new_spearman = $mysql_data["spearman"] - $troops["spearman"];
    $new_axeman = $mysql_data["axeman"] - $troops["axeman"];
    $new_scouthorse = $mysql_data["scouthorse"] - $troops["scouthorse"];
    $new_knighthorse = $mysql_data["knighthorse"] - $troops["knighthorse"];
    $new_warhorse = $mysql_data["warhorse"] - $troops["warhorse"];


    new_event(array("return_completed" => $return_completed, "returning" => "false", "type" => "attack", "completed" => $completed, "target" => $target_id,
        "target_village" => $target_village_id, "userid" => $player_id, "village_id" => $from_village_id,
        "clubswinger" => $troops["clubswinger"], "spearman" => $troops["spearman"], "axeman" => $troops["axeman"],
        "scouthorse" => $troops["scouthorse"], "knighthorse" => $troops["knighthorse"], "warhorse" => $troops["warhorse"]));

    set_array_db(array("clubswinger" => $new_clubswinger, "spearman" => $new_spearman, "axeman" => $new_axeman,
                       "scouthorse" => $new_scouthorse, "knighthorse" => $new_knighthorse, "warhorse" => $new_warhorse), "map", $from_village_id);

    header("location: ../tetrium.php?p=att");
    exit;

}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="attack Function: Attack a village">
function reinforce($from_village_id, $target_village_id, $troops, $player_id)
{


    $mysql_data = get_val($from_village_id);

    if (empty($troops["clubswinger"])) {
        $troops["clubswinger"] = 0;
    }
    if (empty($troops["spearman"])) {
        $troops["spearman"] = 0;
    }
    if (empty($troops["axeman"])) {
        $troops["axeman"] = 0;
    }
    if (empty($troops["scouthorse"])) {
        $troops["scouthorse"] = 0;
    }
    if (empty($troops["knighthorse"])) {
        $troops["knighthorse"] = 0;
    }
    if (empty($troops["warhorse"])) {
        $troops["warhorse"] = 0;
    }


    if ($troops["clubswinger"] < 0 or $troops["spearman"] < 0 or $troops["axeman"] < 0 or $troops["scouthorse"] < 0 or $troops["knighthorse"] < 0 or $troops["warhorse"] < 0) {
        header("location: ../tetrium.php?p=refrs&message=reinforce: only numbers over -1");
        exit;
    }


    if (empty($target_village_id)) {
        header("location: ../tetrium.php?p=refrs&message=reinforce: please fill out the destination");
        exit;
    }

    if ($mysql_data["clubswinger"] < $troops["clubswinger"] or $mysql_data["spearman"] < $troops["spearman"] or $mysql_data["axeman"] < $troops["axeman"] or
        $mysql_data["scouthorse"] < $troops["scouthorse"] or $mysql_data["knighthorse"] < $troops["knighthorse"] or $mysql_data["warhorse"] < $troops["warhorse"]) {
        header("location: ../tetrium.php?p=refrs&message=attack: not enough troops");
        exit;
    }

    $result = mysql_query("SELECT * FROM map WHERE village_id='$from_village_id' and id='$player_id'") or die(mysql_error());
    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_assoc($result)) {
            $from_village_x = $row["x"];
            $from_village_y = $row["y"];
        }
    } else {
        header("location: ../tetrium.php?p=refrs&message=send resources: you can't reinforce from another players village XD");
        exit;
    }
    if ($target_village_id == $from_village_id) {
        header("location: ../tetrium.php?p=refrs&message=you can't reinforce the village you are sending troops from");
        exit;
    }


    /*
    GET RECEIVING VILLAGE DETAILS $X,$Y,$VILLAGE ID USING MAINLY CORDINATES
    */

    if (isset($target_village_id)) {
        $result = mysql_query("SELECT * FROM map where village_id='$target_village_id'") or die(mysql_error());
        if (mysql_num_rows($result) > 0) {
            while ($info = mysql_fetch_array($result)) {
                $target_village_id = $info["village_id"];
                $x = $info["x"];
                $y = $info["y"];
                $target_id = $info["id"];
            }
        } else {
            header("location: ../tetrium.php?p=refrs&message=send resources: no such village exists");
            exit;
        }
    }

    /*
    END GET RECEIVING VILLAGE DETAILS
    */

    $x_distance = abs($from_village_x - $x); //absolute value
    $y_distance = abs($from_village_y - $y); //absolute value

    if ($troops["scouthorse"] > 0) {
        $speed = 10;
    }
    if ($troops["knighthorse"] > 0) {
        $speed = 8;
    }
    if ($troops["warhorse"] > 0) {
        $speed = 6;
    }
    if ($troops["spearman"] > 0) {
        $speed = 4;
    }
    if ($troops["axeman"] > 0 or $troops["clubswinger"] > 0) {
        $speed = 3;
    }


    $time = round((sqrt(pow($x_distance, 2) + pow($y_distance, 2)) / $speed) * 60);//Time in minutes
    $time_return = $time * 2;//Time in minutes

    $completed = date("Y-m-d H:i:s", strtotime("$time minutes"));
    $return_completed = date("Y-m-d H:i:s", strtotime("$time_return minutes"));

    $new_clubswinger = $mysql_data["clubswinger"] - $troops["clubswinger"];
    $new_spearman = $mysql_data["spearman"] - $troops["spearman"];
    $new_axeman = $mysql_data["axeman"] - $troops["axeman"];
    $new_scouthorse = $mysql_data["scouthorse"] - $troops["scouthorse"];
    $new_knighthorse = $mysql_data["knighthorse"] - $troops["knighthorse"];
    $new_warhorse = $mysql_data["warhorse"] - $troops["warhorse"];


    new_event(array("return_completed" => $return_completed, "returning" => "false", "type" => "reinforce", "completed" => $completed, "target" => $target_id,
        "target_village" => $target_village_id, "userid" => $player_id, "village_id" => $from_village_id,
        "clubswinger" => $troops["clubswinger"], "spearman" => $troops["spearman"], "axeman" => $troops["axeman"],
        "scouthorse" => $troops["scouthorse"], "knighthorse" => $troops["knighthorse"], "warhorse" => $troops["warhorse"]));

    set_array_db(array("clubswinger" => $new_clubswinger, "spearman" => $new_spearman, "axeman" => $new_axeman,
        "scouthorse" => $new_scouthorse, "knighthorse" => $new_knighthorse, "warhorse" => $new_warhorse), "map", $from_village_id);

    header("location: ../tetrium.php?p=refrs");
    exit;

}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="speedup Function: Cheat on event timers">
function speedup($event_id)
{
    if ($_SESSION['varadmin'] == 0) {
        return "ERROR: Not admin";
    }
    if (mysql_num_rows(mysql_query("SELECT * FROM events WHERE id='$event_id'")) == 0) {
        return "ERROR: Event id " . $event_id . " does not exist";
    }

    $result = mysql_query("SELECT * FROM events WHERE id='$event_id'");
    while ($row = mysql_fetch_assoc($result)) {
        $type = $row["type"];
        $returning = $row["returning"];
    }
    if (!in_array($type, array("building", "train", "attack", "sendres", "settle"))) {
        return "ERROR: not a type";
    }
    if ($type == "building" or $type == "train" or $type == "attack" or $type == "sendres" or $type == "settle") {

        mysql_query("UPDATE events SET completed=0 WHERE id='$event_id'") or die(mysql_error());
        if ($returning == 1) {
            mysql_query("UPDATE events SET return_completed=0 WHERE id='$event_id'") or die(mysql_error());
        }
        header("location: ../tetrium.php?p=res&message=time hacked");
        exit;
    }


}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="change_pass Function: Change player password">
function change_pass($user, $newpass)
{

    include_once("../includes/databasedetails.php");

    $newpass = md5($newpass);
    mysql_query("UPDATE members SET password = '$newpass' WHERE username = '$user'");

    header("location:../tetrium.php?p=res");
    exit;
}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="market_action Function: Trade market resources">
function market_action($village_id, $give_wood, $give_clay, $give_iron, $give_wheat, $want)
{
    $mysql_data = get_val($village_id);

    if ($give_wood > $mysql_data["wood"]) {
        return "Not enough wood";
    } else {
        $newwood = $mysql_data["wood"] - $give_wood;
        $getresources = $getresources + $give_wood;
    }
    if ($give_clay > $mysql_data["clay"]) {
        return "not enough clay";
    } else {
        $newclay = $mysql_data["clay"] - $give_clay;
        $getresources = $getresources + $give_clay;
    }
    if ($give_iron > $mysql_data["iron"]) {
        return "not enough iron";
    } else {
        $newiron = $mysql_data["iron"] - $give_iron;
        $getresources = $getresources + $give_iron;
    }
    if ($give_wheat > $mysql_data["wheat"]) {
        return "not enough wheat";
    } else {
        $newwheat = $mysql_data["wheat"] - $give_wheat;
        $getresources = $getresources + $give_wheat;
    }


    $market_level_multiplier = ($mysql_data["marketplace"] / 50);
    $market_multiplier = 0.80 + $market_level_multiplier;

//MAX MARKET MULTIPLIER
    if ($market_multiplier > 1) {
        $market_multiplier = 1;
    }

    $getresources = $getresources * $market_multiplier;

    if ($want == 1) {
        $newwood = $newwood + $getresources;
    }
    if ($want == 2) {
        $newclay = $newclay + $getresources;
    }
    if ($want == 3) {
        $newiron = $newiron + $getresources;
    }
    if ($want == 4) {
        $newwheat = $newwheat + $getresources;
    }

    $res = array("wood" => $newwood, "clay" => $newclay, "iron" => $newiron, "wheat" => $newwheat);
    set_array_db($res, "map", $village_id);

    header("location: ../tetrium.php?p=ugg&building=marketplace");
    exit;
}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="logout Function: Logout">
function logout()
{
    session_destroy();
    header("location: ../tetrium.php?p=res");
    exit;
}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="del_report Function: Delete report">
function del_report($report_id)
{
    if (isset($report_id)) {
        mysql_query("DELETE FROM reports WHERE report_id='$report_id'");
    } else {
        return "error report id:" . $report_id . "does not exist";
    }
    header("location: ../tetrium.php?p=rep");
    exit;
}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="send_mail Function: Send mail">
function send_mail($sender, $receiver, $topic, $mail)
{
    $now = date('Y-m-d H:i:s');
    mysql_query("INSERT INTO messages (sender, receiver, topic, message, time) VALUES ('$sender', '$receiver', '$topic', '$message', '$now')") or die(mysql_error());
    header("location: ../tetrium.php?p=msg");
    exit;
}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="print_debug Function: Print village debug">
function print_debug($village_id)
{
    $mysql_data = get_val($village_id);
    if ($_SESSION["varadmin"] == 1) {
        ?>
        <a id="show_id"
           onclick="document.getElementById('spoiler_id').style.display=''; document.getElementById('show_id').style.display='none';"
           class="link">[Show Debug]</a><span id="spoiler_id" style="display: none"><a
                onclick="document.getElementById('spoiler_id').style.display='none'; document.getElementById('show_id').style.display='';"
                class="link">[Hide Debug]</a><br><?php table_print_r($mysql_data); ?></span>
        <?php
        if ($_GET["show_debug"] == 1) {
            ?>
            <script>document.getElementById('spoiler_id').style.display = '';
                document.getElementById('show_id').style.display = 'none';</script><?php
        }
    }
}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="table_print_r Function: Array to table">
function table_print_r($my_array)
{
    if (is_array($my_array)) {
        echo "<table border=1 cellspacing=0 cellpadding=3 width=100px>";
        echo '<tr><td colspan=2 style="background-color:#333333;"><strong><font color=white>ARRAY</font></strong></td></tr>';
        foreach ($my_array as $k => $v) {
            echo '<tr><td valign="top" style="width:40px;background-color:#F0F0F0;">';
            echo '<strong>' . $k . "</strong></td><td>";
            table_print_r($v);
            echo "</td></tr>";
        }
        echo "</table>";
        return;
    }
    echo $my_array;
}
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="get_village_id Function: Get village id on base of x y and name">
function get_village_id($x, $y, $vname)
{
    if (isset($vname)) {
        $query = mysql_query("SELECT village_id FROM map WHERE village='$vname'");
    } else {
        $query = mysql_query("SELECT village_id FROM map WHERE x='$x' AND y='$y'");
    }

    if (mysql_num_rows($query) > 1) {
        echo "SORRY, multiple villages with that name exist";
        exit;
    }
    if (mysql_num_rows($query) == 0) {
        echo "ERROR: Village with that name doesn't exist (Remember that village names are case sensitive)";
        exit;
    }

    while ($row = mysql_fetch_assoc($query)) {
        $vid = $row["village_id"];
    }
    return $vid;
}
//</editor-fold>