#!/usr/bin/php5
<?php
// Parse command line arguments into the $_GET variable:
parse_str(implode('&', array_slice($argv, 1)), $_GET);

echo 'Owner: ' . $_GET['owner'] . "\n";
echo 'Name: ' . $_GET['name'] . "\n";
echo 'Group: ' . $_GET['group'] . "\n";
echo 'Description: ' . $_GET['description'] . "\n";

$owner       = ucwords($_GET['owner']);
$name        = ucwords($_GET['name']);
$lc_name     = strtolower($name);
$uc_name     = strtoupper($name);
$plg_lc_name = 'plg_' . str_replace(' ', '', $lc_name);
$plg_uc_name = strtoupper(str_replace(' ', '', $plg_lc_name));

$description = $_GET['description'];

$group        = ucwords($_GET['group']);
$lc_group     = strtolower($group);
$uc_group     = strtoupper($group);
$plg_lc_group = 'plg_' . str_replace(' ', '', $lc_group);
$plg_uc_group = strtoupper(str_replace(' ', '', $plg_lc_group));


$classname   = str_replace(' ', '', $name);
#$classname   = $group . str_replace(' ', '', $name);

echo 'Classname: ' . $classname . "\n";

include_once('_functions.php');

$new_dir     = dirname(__DIR__) . '/__builds/' . $plg_lc_name;

copy_dir(__DIR__ . '/_plg_plgn', $new_dir);

perform_renames(
    $new_dir,
    [
        '_plgn' => str_replace(' ', '', $lc_name),
        '_grp'  => $lc_group,
        '_Plgn' => $classname
    ],
    [
        '{{OWNER}}'         => $owner,
        '{{NAME}}'          => $name,
        '{{NAME-NO-SPACE}}' => str_replace(' ', '', $name),
        '{{DESCRIPTION}}'   => $description,
        '{{GRP}}'           => $group,
        '_plgn'             => str_replace(' ', '', $lc_name),
        '_grp'              => $lc_group,
        '_Plgn'             => $classname,
        'GRP'               => $uc_group,
        '_PLGN'             => '_' . str_replace(' ', '', $uc_name),
        '{{MONTH}}'         => date('F'),
        '{{YEAR}}'          => date('Y')
    ]
);

perform_renames(
    $new_dir,
    array('_grp', $lc_group)
);
?>