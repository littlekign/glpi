<?php
/*
 * @version $Id$
 ----------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2006 by the INDEPNET Development Team.
 
 http://indepnet.net/   http://glpi.indepnet.org
 ----------------------------------------------------------------------

 LICENSE

	This file is part of GLPI.

    GLPI is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    GLPI is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with GLPI; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 ------------------------------------------------------------------------
*/
 
// ----------------------------------------------------------------------
// Original Author of file: Julien Dombre
// Purpose of file:
// ----------------------------------------------------------------------

include ("_relpos.php");
$NEEDED_ITEMS=array("infocom","computer","printer","monitor","peripheral","networking","software","cartridge","consumable","enterprise","contract");
include ($phproot . "/inc/includes.php");


checkRight("contract_infocom","r");

nullHeader($lang["title"][21],$_SERVER["PHP_SELF"]);

$ci=new CommonItem();

if (isset($_GET["ID"])){
	$ic=new Infocom();
	$ic->getFromDB($_GET["ID"]);
	$_GET["device_type"]=$ic->fields["device_type"];
	$_GET["device_id"]=$ic->fields["FK_device"];
}

if(!isset($_GET["device_type"])||!isset($_GET["device_id"])||!$ci->getFromDB($_GET["device_type"],$_GET["device_id"]))
echo "<div align='center'>".$lang["financial"][85]."</div>";
else {
	
	echo "<div align='center'><strong>".$ci->getType()." - ".$ci->getLink()."</strong></div>";
	if (isset($_GET["update"])&&$_GET["update"]==1) $withtemplate=0;
	else $withtemplate=2;
	showInfocomForm ($HTMLRel."front/infocom.form.php",$_GET["device_type"],$_GET["device_id"],1,$withtemplate);
}


commonFooter();

?>
