<?PHP
//////////////////////////////////////////////////////////////////////////////

require_once("inc/setup.php");

//////////////////////////////////////////////////////////////////////////////

$cms_html_title = "Browsing Items";
require_once("inc/header.php");


//////////////////////////////////////////////////////////////////////////////
?>


<h2>Tables</h2>

<hr class="chubby">

<?PHP
		//////////////////////////////////////////////////////////////////////////////
		// Loop through all tables and display them
		
		$groupIndex = 0;
		foreach($visible_tables as $groupCaption => $tables){
?>

<table id="group_<?PHP echo $groupIndex; ?>" class="tables_table table<?PHP if ($visible_tables_groups_count>1): ?> toggle<?PHP if (!in_array($groupIndex, explode(',', $_SESSION['settings_open_table_group']))): ?> closed<?PHP endif; endif; ?>" cellpadding="0" cellspacing="0" border="0" style="width:100%">
	<thead>
		<tr>
			<th class="icon"><?PHP if ($visible_tables_groups_count>1): ?><span class="item_module_toggle ui-icon down"></span><?PHP endif; ?></th>
			<th class="first_field"><?PHP echo $groupCaption ? uc_convert($groupCaption) : 'Table'; ?></th>
			<th width="10%">Active Items</th>
		</tr>
	</thead>
	<tbody class="check_no_rows">
		<?PHP
			foreach ($tables as $table){
			
				// If table is not hidden and user has access to table, all or is admin OR ALL IS TRUE
				if((strpos($cms_user["view"],',' . $table . ',') !== false || $cms_user["view"] == 'all' || $cms_user["admin"] == '1') && !in_array($table,$settings['table_hidden'])){
					
					$table_info = get_rows_info($table);
					$add_or_edit = ($table_info['num'] == 0)? '':'&item=1';
					?>
					<tr onclick="location.href='<?PHP echo (in_array($table,$settings['table_single']))? 'edit.php?table=' . $table . $add_or_edit : 'browse.php?table=' . $table; ?>'">
						<td class="icon"><img src="media/site/icons/<?PHP echo (in_array($table,$settings['table_single']))?'database-arrow':'database';?>.png" width="16" height="16" /></td>
						<td class="first_field"><div class="wrap"><?PHP echo uc_table($table); ?></div></td>
						<td class="text_right"><?PHP echo $table_info['num']; ?></td>
					</tr>
					<?PHP
				}
			}
		?>
		<tr class="item no_rows"><td colspan="3">No tables available</td></tr>
	</tbody>
</table>

<?PHP
			$groupIndex = $groupIndex + 1;
		}
		
		//////////////////////////////////////////////////////////////////////////////

require_once("inc/footer.php");
?>