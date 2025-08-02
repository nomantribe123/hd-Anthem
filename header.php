<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php wp_title() ?></title>

    <!--responsive-->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="apple-touch-icon" sizes="57x57" href="assets/img/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/img/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/img/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/img/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <meta name="msapplication-TileImage" content="assets/img/favicons/ms-icon-144x144.png">

    <link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> 
      x-data
      x-on:resize.window.debounce="$store.page.resized()"
      x-on:scroll.window.debounce="$store.page.scrolled()">


    <header class="bg-white fixed top-0 left-0 right-0 z-10 w-full">
        <div class="secondary-links flex items-cente bg-anthem-grey-4">
            <div class="container flex justify-center lg:justify-start gap-x-4">
                <a href="/brochures/" class="flex items-center gap-2">
                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg"><mask id="mask0_10974_6364" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="17"><path d="M0 0.500001H16V16.5H0V0.500001Z" fill="white"/></mask><g mask="url(#mask0_10974_6364)"><path d="M2.26841 3.24497C1.64631 3.3719 1.04587 3.57525 0.46875 3.86078V15.2657C3.22256 14.3772 5.66312 14.6323 8 15.2657" stroke="black" stroke-width="1.3" stroke-miterlimit="22.926" stroke-linecap="round" stroke-linejoin="round"/><path d="M13.7309 3.24484C14.3532 3.37178 14.9539 3.57515 15.5312 3.86078V15.2657C12.7774 14.3772 10.3369 14.6323 8 15.2657" stroke="black" stroke-width="1.3" stroke-miterlimit="22.926" stroke-linecap="round" stroke-linejoin="round"/><path d="M2.34375 1.97772C4.06237 1.36047 7.375 1.89203 8 3.86078V14.9532C6.76628 13.7195 4.56722 12.4477 2.34375 13.0702V1.97772Z" stroke="black" stroke-width="1.3" stroke-miterlimit="22.926" stroke-linecap="round" stroke-linejoin="round"/><path d="M13.6562 1.97772C11.9376 1.36047 8.625 1.89203 8 3.86078V14.9532C9.23372 13.7195 11.4327 12.4477 13.6562 13.0702V1.97772Z" stroke="black" stroke-width="1.3" stroke-miterlimit="22.926" stroke-linecap="round" stroke-linejoin="round"/></g></svg>
                    Brochures
                </a>
                <a href="/sustainability/" class="flex items-center gap-2">
                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 0.5C3.5888 0.5 0 4.0888 0 8.5C0 12.9112 3.5888 16.5 8 16.5C12.4112 16.5 16 12.9112 16 8.5C16 4.0888 12.4112 0.5 8 0.5ZM1.6 8.5C1.6 7.7808 1.7248 7.0904 1.9448 6.4448L4.8 9.3V10.9L7.2 13.3V14.8448C4.0488 14.4488 1.6 11.7576 1.6 8.5ZM13.064 12.3984C12.5416 11.9776 11.7496 11.7 11.2 11.7V10.9C11.2 10.4757 11.0314 10.0687 10.7314 9.76863C10.4313 9.46857 10.0243 9.3 9.6 9.3H6.4V6.9C6.82435 6.9 7.23131 6.73143 7.53137 6.43137C7.83143 6.13131 8 5.72435 8 5.3V4.5H8.8C9.22435 4.5 9.63131 4.33143 9.93137 4.03137C10.2314 3.73131 10.4 3.32435 10.4 2.9V2.5712C12.7424 3.5224 14.4 5.82 14.4 8.5C14.3999 9.91176 13.9298 11.2833 13.064 12.3984Z" fill="#181818"/></svg>
                    Sustainability 
                </a>
            </div>
        </div>

        <div class="primary-links container">

            <?php get_template_part('template-parts/header/desktop-menu'); ?>            

            <?php get_template_part('template-parts/header/mobile-menu'); ?>
        </div>
    </header>

    <main x-data="products()">
