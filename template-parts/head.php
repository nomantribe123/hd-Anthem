<?php
/**
 * Template for displaying head
 *
 * @package Anthem
 * @since 1.0.0
 */

global $anthem;
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="<?php echo esc_url( $anthem['site_favicon']['url'] ); ?>">
	<meta name="keywords" content="<?php echo esc_attr( $anthem['site_keywords'] ); ?>">
	
	<link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>
