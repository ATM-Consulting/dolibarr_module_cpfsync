<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) 2015 ATM Consulting <support@atm-consulting.fr>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * 	\file		admin/cpfsync.php
 * 	\ingroup	cpfsync
 * 	\brief		This file is an example module setup page
 * 				Put some comments here
 */
// Dolibarr environment
$res = @include("../../main.inc.php"); // From htdocs directory
if (! $res) {
    $res = @include("../../../main.inc.php"); // From "custom" directory
}

// Libraries
require_once DOL_DOCUMENT_ROOT . "/core/lib/admin.lib.php";
require_once '../lib/cpfsync.lib.php';

// Translations
$langs->load("admin");
$langs->load("cpfsync@cpfsync");

// Access control
if (! $user->admin) {
    accessforbidden();
}

// Parameters
$action = GETPOST('action', 'alpha');

/*
 * Actions
 */
if (preg_match('/set_(.*)/',$action,$reg))
{
	$code=$reg[1];
	if (dolibarr_set_const($db, $code, GETPOST($code), 'chaine', 0, '', $conf->entity) > 0)
	{
		header("Location: ".$_SERVER["PHP_SELF"]);
		exit;
	}
	else
	{
		dol_print_error($db);
	}
}
	
if (preg_match('/del_(.*)/',$action,$reg))
{
	$code=$reg[1];
	if (dolibarr_del_const($db, $code, 0) > 0)
	{
		Header("Location: ".$_SERVER["PHP_SELF"]);
		exit;
	}
	else
	{
		dol_print_error($db);
	}
}

/*
 * View
 */
$page_name = "cpfsyncSetup";
llxHeader('', $langs->trans($page_name));

// Subheader
$linkback = '<a href="' . DOL_URL_ROOT . '/admin/modules.php">'
    . $langs->trans("BackToModuleList") . '</a>';
print_fiche_titre($langs->trans($page_name), $linkback);

// Configuration header
$head = cpfsyncAdminPrepareHead();
dol_fiche_head(
    $head,
    'settings',
    $langs->trans("Module104340Name"),
    0,
    "cpfsync@cpfsync"
);

// Setup page goes here
$form=new Form($db);
$var=false;
print '<table class="noborder" width="100%">';
print '<tr class="liste_titre">';
print '<td>'.$langs->trans("Parameters").'</td>'."\n";
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="center" width="100">'.$langs->trans("Value").'</td>'."\n";


// Example with a yes / no select
$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("cpfsyncDescCustomer").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="600">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_CPFSYNC_SHARE_CUSTOMER">';
print $form->selectyesno("CPFSYNC_SHARE_CUSTOMER",$conf->global->CPFSYNC_SHARE_CUSTOMER,1);
print '<input type="submit" class="button" value="'.$langs->trans("Modify").'">';
print '</form>';
print '</td></tr>';

$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("cpfsyncDescProduct").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="600">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_CPFSYNC_SHARE_PRODUCT">';
print $form->selectyesno("CPFSYNC_SHARE_PRODUCT",$conf->global->CPFSYNC_SHARE_PRODUCT,1);
print '<input type="submit" class="button" value="'.$langs->trans("Modify").'">';
print '</form>';
print '</td></tr>';

$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("cpfsyncDescInvoice").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="600">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_CPFSYNC_SHARE_INVOICE">';
print $form->selectyesno("CPFSYNC_SHARE_INVOICE",$conf->global->CPFSYNC_SHARE_INVOICE,1);
print '<input type="submit" class="button" value="'.$langs->trans("Modify").'">';
print '</form>';
print '</td></tr>';

$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("cpfsyncDescStock").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="600">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_CPFSYNC_SHARE_STOCK">';
print $form->selectyesno("CPFSYNC_SHARE_STOCK",$conf->global->CPFSYNC_SHARE_STOCK,1);
print '<input type="submit" class="button" value="'.$langs->trans("Modify").'">';
print '</form>';
print '</td></tr>';

$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("cpfsyncDescUrlDistant").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="600">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_CPFSYNC_URL_DISTANT">';
print '<input size="60" type="text" name="CPFSYNC_URL_DISTANT" value="'.$conf->global->CPFSYNC_URL_DISTANT.'" />';
print '<input id="testConnection" type="button" class="button" value="'.$langs->trans("Test").'">';
print '<input type="submit" class="button" value="'.$langs->trans("Modify").'">';
print '</form>';
print '</td></tr>';

$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("cpfsyncDescUser").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="600">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_CPFSYNC_ID_USER">';
print $form->select_dolusers($conf->global->CPFSYNC_ID_USER, "CPFSYNC_ID_USER");
print '<input type="submit" class="button" value="'.$langs->trans("Modify").'">';
print '</form>';
print '</td></tr>';

print '</table>';

echo cpfsyncAdminPrintJsTest();

llxFooter();

$db->close();