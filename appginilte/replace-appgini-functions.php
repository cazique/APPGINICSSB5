<?php // Save this file as 'hooks/replace-appgini-functions.php'

$hooks_dir = dirname(__FILE__);
include("{$hooks_dir}/../defaultLang.php");
include("{$hooks_dir}/../language.php");
include("{$hooks_dir}/../lib.php");

// Step 1: Specify the file containing the function we want to overwrite
$appgini_file = "{$hooks_dir}/../incCommon.php";

// Step 2: Specify the file containing our version of the function
$mod_file = "{$hooks_dir}/mod.htmlUserBar.php";

// Step 3: Specify the name of the function we want to overwrite
$func_name = 'htmlUserBar';

echo "htmlUserBar: Replacement skipped for compatibility testing.<br>" . replaceIndex() . createDashboardViews();

#######################################

function replace_function($appgini_file, $function_name, $mod_file)
{
	// read the new code from the mod file
	$new_code = @file($mod_file);
	if (empty($new_code)) return 'No custom code found.';

	// remove the first line containing PHP opening tag and keep the rest as $new_snippet
	array_shift($new_code);
	$new_snippet = implode('', $new_code);

	$pattern1 = '/\s*function\s+' . $function_name . '\s*\(.*\).*(\R.*){200}/';
	$pattern2 = '/\t#+(.*\R)*/';

	$entire_code = file_get_contents($appgini_file);
	if (!$entire_code) return 'Invalid AppGini file.';

	$m = [];
	if (!preg_match_all($pattern1, $entire_code, $m)) return 'Function to replace not found.';
	$snippet = $m[0][0] . "\n";

	if (!preg_match_all($pattern2, $snippet, $m)) return 'Could not find the end of the function.';
	$snippet = str_replace($m[0][0], '', $snippet);

	$snippet_nocrlf = str_replace("\r\n", "\n", $snippet);
	$new_snippet_nocrlf = str_replace("\r\n", "\n", $new_snippet);
	if (trim($snippet_nocrlf) == trim($new_snippet_nocrlf)) return 'Function already replaced.';

	// back up the file before overwriting
	if (!@copy(
		$appgini_file,
		preg_replace('/\.php$/', '.backup.' . date('Y.m.d.H.i.s') . '.php', $appgini_file)
	)) return 'Could not make a backup copy of file.';

	$new_code = str_replace(trim($snippet), trim($new_snippet), $entire_code);
	if (!@file_put_contents($appgini_file, $new_code)) return "Couldn't overwrite file.";

	return 'Function overwritten successfully.';
}

function replaceIndex()
{
	global $hooks_dir;
	$index_file = "{$hooks_dir}/../index.php";

	// Attempt to read the index file
	$file_content = @file_get_contents($index_file);
	if ($file_content === false) {
		return "Error: Could not read {$index_file}. Please check file permissions and path.";
	}

	// Check if 'appginilte_dashboard.php' is already present
	if (strpos($file_content, 'appginilte_dashboard.php') !== false) {
		return "Index file already includes 'appginilte_dashboard.php'. No replacement made.";
	}

	// Check if 'home.php' is present for replacement
	if (strpos($file_content, 'home.php') === false) {
		return "Original 'home.php' include not found in {$index_file}. No replacement made.";
	}

	// Perform the replacement
	// Note: Consider implementing a backup mechanism for $index_file here,
	// similar to the one in replace_function(), before writing changes.
	// For example:
	// if (!@copy($index_file, preg_replace('/\.php$/', '.backup.' . date('Y.m.d.H.i.s') . '.php', $index_file))) {
	//     return "Warning: Could not create a backup of {$index_file}. Proceeding without backup.";
	// }
	$new_content = str_replace('home.php', 'appginilte_dashboard.php', $file_content);

	// Write the modified content back to the index file
	if (@file_put_contents($index_file, $new_content) === false) {
		return "Error: Could not write changes to {$index_file}. Please check file permissions.";
	}

	return 'Index file successfully modified to use appginilte_dashboard.php.';
}

function createDashboardViews()
{
	global $hooks_dir;
	$abovehomelinks_content='';
	$belowhomelinks_content='';
	$groups = sql("SELECT `name` FROM membership_groups",$eo);
	foreach ($groups as $grp => $data) {
		$gn = str_replace(" ", "_", $data['name']);
		$viewpage_Top = "{$hooks_dir}/views/" . $gn . "_Top.php";
		$viewpage_Bottom = "{$hooks_dir}/views/" . $gn . "_Bottom.php";
		if (!file_exists($viewpage_Top) || !file_exists($viewpage_Bottom)) {
			$contents = "\n".'
			<div class="row">
			<div class="col-md-12">
			
			</div>
			</div>'."\n";
			// initialize content for this file
			file_put_contents($viewpage_Top, '<!--Write your '.$data['name'].' group specific dashboard content and logic in here, this could be charts,cards widgets,tables and everything in between. This content will be shown above home links/cards on the dashboard-->'.$contents); // Save our content to the file.
			file_put_contents($viewpage_Bottom, '<!--Write your '.$data['name'].' group specific dashboard content and logic in here, this could be charts,cards widgets,tables and everything in between.This content will be shown below home links/cards on the dashboard-->'.$contents); // Save our content to the file.
			echo "<br> appginilte/" . $viewpage_Top . " Created Successfully <br>";
			echo "<br> appginilte/" . $viewpage_Bottom . " Created Successfully <br>";
		}
		$abovehomelinks_content.="\n".'if ($group=="'.$gn.'") {
			include "views/'.$gn.'_Top.php";
			}'."\n";
		$belowhomelinks_content.="\n".'if ($group=="'.$gn.'") {
			include "views/'.$gn.'_Bottom.php";
		}'."\n";
	}
	$abovehomelinks="{$hooks_dir}/above_homelinks.php";
	$belowhomelinks="{$hooks_dir}/below_homelinks.php";

	if (!@file_put_contents($abovehomelinks, "<?php ".$abovehomelinks_content." ?>")) return "Couldn't overwrite Index file.";
	if (!@file_put_contents($belowhomelinks, "<?php ".$belowhomelinks_content." ?>")) return "Couldn't overwrite Index file.";

	return '<br> Above/Below home page files created success';
}