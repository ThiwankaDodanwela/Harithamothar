<?php /* Template Name: ajax-projects */
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage PixelsDen
 * @since 1.0
 * @version 1.0
 */ 

$start = $_REQUEST["start"];
$limit = $_REQUEST["limit"];
$proj_id = get_id_by_slug("projects");
$projects = get_field('project',$proj_id);

$reultsArray = array_slice($projects, $start,$limit);
$proObj->Results = $reultsArray;
$proObj->Count =  count($projects);

echo json_encode($proObj);
?>