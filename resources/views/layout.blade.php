<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ URL::asset('css/content_management/style.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- JQuery cdn --}}
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>

        <!-- Favicons -->
        <meta name="theme-color" content="#7952b3">


    <style>
        #sidebarMenu {
            background-color: #343a40!important;
            {{-- max-width: 250px; --}}
        }

        .sidebar .nav-link {
            color: #c2c7d0 !important;
        }

        .sidebar .nav-link.active {
            color: #659ff3 !important;
        }

        li.nav-item {
            padding-left: 0.5rem;
        }

        a.nav-link {
            font-size: 16px;
        }

        li svg {
            margin-top: -5px;
        }

        {{-- .pl-to-menu {
            padding-left: 0 !important;
        } --}}

      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.0/examples/dashboard/dashboard.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/timepicker@1.13.18/jquery.timepicker.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/timepicker@1.13.18/jquery.timepicker.min.js"></script>

  </head>
  <body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{ route('dashboard') }}">Dashboard</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    {{-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> --}}
    <div class="navbar-nav">

        <div class="nav-item text-nowrap">
            <form class="nav-link px-3 text-white" method="POST" action="{{ route('logout') }}">
                @csrf

                <x-jet-dropdown-link href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                this.closest('form').submit();">
                    {{ __('Sign out') }}
                </x-jet-dropdown-link>
            </form>
        </div>
    </div>
    </header>

<div class="container-fluid">
  <div class="row">
   <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
    @can('view admin menu')
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Customers</span>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link @if(app()->view->getSections()['title'] == 'Users')
                                active
                                @endif" aria-current="page" href="{{ route('users.index') }}">
            <svg aria-hidden="true" width="20" height="20" focusable="false" data-prefix="fas" data-icon="users" class="svg-inline--fa fa-users fa-w-20 fa-1x nav-icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z"></path></svg>
            Users
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(app()->view->getSections()['title'] == 'Business')
                                active
                                @endif" aria-current="page" href="{{ route('business.index') }}">
            <svg aria-hidden="true" width="20" height="20" focusable="false" data-prefix="fas" data-icon="user-tie" class="svg-inline--fa fa-user-tie fa-w-14 fa-1x nav-icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm95.8 32.6L272 480l-32-136 32-56h-96l32 56-32 136-47.8-191.4C56.9 292 0 350.3 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-72.1-56.9-130.4-128.2-133.8z"></path></svg>
            Business
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Content management</span>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link @if(app()->view->getSections()['title'] == 'Listings')
                                active
                                @endif" href="{{ route('listings.index') }}">
            <svg aria-hidden="true" width="20" height="20" focusable="false" data-prefix="fas" data-icon="ad" class="svg-inline--fa fa-handshake fa-w-20 fa-1x nav-icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M157.52 272h36.96L176 218.78 157.52 272zM352 256c-13.23 0-24 10.77-24 24s10.77 24 24 24 24-10.77 24-24-10.77-24-24-24zM464 64H48C21.5 64 0 85.5 0 112v288c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM250.58 352h-16.94c-6.81 0-12.88-4.32-15.12-10.75L211.15 320h-70.29l-7.38 21.25A16 16 0 0 1 118.36 352h-16.94c-11.01 0-18.73-10.85-15.12-21.25L140 176.12A23.995 23.995 0 0 1 162.67 160h26.66A23.99 23.99 0 0 1 212 176.13l53.69 154.62c3.61 10.4-4.11 21.25-15.11 21.25zM424 336c0 8.84-7.16 16-16 16h-16c-4.85 0-9.04-2.27-11.98-5.68-8.62 3.66-18.09 5.68-28.02 5.68-39.7 0-72-32.3-72-72s32.3-72 72-72c8.46 0 16.46 1.73 24 4.42V176c0-8.84 7.16-16 16-16h16c8.84 0 16 7.16 16 16v160z"></path></svg>
            Listings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(app()->view->getSections()['title'] == 'Deals')
                                active
                                @endif" href="{{ route('deals.index') }}">
            <svg aria-hidden="true" width="20" height="20" focusable="false" data-prefix="fas" data-icon="handshake" class="svg-inline--fa fa-handshake fa-w-20 fa-1x nav-icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M434.7 64h-85.9c-8 0-15.7 3-21.6 8.4l-98.3 90c-.1.1-.2.3-.3.4-16.6 15.6-16.3 40.5-2.1 56 12.7 13.9 39.4 17.6 56.1 2.7.1-.1.3-.1.4-.2l79.9-73.2c6.5-5.9 16.7-5.5 22.6 1 6 6.5 5.5 16.6-1 22.6l-26.1 23.9L504 313.8c2.9 2.4 5.5 5 7.9 7.7V128l-54.6-54.6c-5.9-6-14.1-9.4-22.6-9.4zM544 128.2v223.9c0 17.7 14.3 32 32 32h64V128.2h-96zm48 223.9c-8.8 0-16-7.2-16-16s7.2-16 16-16 16 7.2 16 16-7.2 16-16 16zM0 384h64c17.7 0 32-14.3 32-32V128.2H0V384zm48-63.9c8.8 0 16 7.2 16 16s-7.2 16-16 16-16-7.2-16-16c0-8.9 7.2-16 16-16zm435.9 18.6L334.6 217.5l-30 27.5c-29.7 27.1-75.2 24.5-101.7-4.4-26.9-29.4-24.8-74.9 4.4-101.7L289.1 64h-83.8c-8.5 0-16.6 3.4-22.6 9.4L128 128v223.9h18.3l90.5 81.9c27.4 22.3 67.7 18.1 90-9.3l.2-.2 17.9 15.5c15.9 13 39.4 10.5 52.3-5.4l31.4-38.6 5.4 4.4c13.7 11.1 33.9 9.1 45-4.7l9.5-11.7c11.2-13.8 9.1-33.9-4.6-45.1z"></path></svg>
            Deals
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(app()->view->getSections()['title'] == 'Banners')
                                active
                                @endif" href="{{ route('banners.index') }}">
            <svg aria-hidden="true" width="20" height="20" focusable="false" data-prefix="fas" data-icon="address-book" class="svg-inline--fa fa-address-book fa-w-14 fa-1x nav-icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M436 160c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-20V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h320c26.5 0 48-21.5 48-48v-48h20c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-20v-64h20c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-20v-64h20zm-228-32c35.3 0 64 28.7 64 64s-28.7 64-64 64-64-28.7-64-64 28.7-64 64-64zm112 236.8c0 10.6-10 19.2-22.4 19.2H118.4C106 384 96 375.4 96 364.8v-19.2c0-31.8 30.1-57.6 67.2-57.6h5c12.3 5.1 25.7 8 39.8 8s27.6-2.9 39.8-8h5c37.1 0 67.2 25.8 67.2 57.6v19.2z"></path></svg>
            Banners
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(app()->view->getSections()['title'] == 'Events')
                                active
                                @endif" href="{{ route('events.index') }}">
            <svg aria-hidden="true" width="20" height="20" focusable="false" data-prefix="fas" data-icon="calendar" class="svg-inline--fa fa-calendar fa-w-14 fa-1x nav-icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M12 192h424c6.6 0 12 5.4 12 12v260c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V204c0-6.6 5.4-12 12-12zm436-44v-36c0-26.5-21.5-48-48-48h-48V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H160V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H48C21.5 64 0 85.5 0 112v36c0 6.6 5.4 12 12 12h424c6.6 0 12-5.4 12-12z"></path></svg>
            Events
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(app()->view->getSections()['title'] == 'Blog')
                                active
                                @endif" href="{{ route('blog.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><path fill="currentColor" d="M203.2,0c-6-0.2-11.1,4.7-11.1,10.9v42.3c0,6,4.7,10.7,10.7,10.7v0.4c133,5.1,239.9,112.1,245,245h0.4   c0,6,4.7,10.7,10.7,10.7h42.3c6.2,0,11.1-5.1,10.9-11.1C506.2,141.1,370.9,5.8,203.2,0z M203.2,106.7c-6-0.2-11.1,4.9-11.1,10.9   v42.3c0,6,4.7,10.7,10.7,10.7v0.6c74.1,4.9,133.2,64,138.1,138.1h0.6c0,6,4.7,10.7,10.7,10.7h42.3c6,0,11.1-5.1,10.9-11.1   C399.5,200,312,112.5,203.2,106.7z M10.7,127.8c-6,0-10.7,4.7-10.7,10.7v234.8C0,449.7,62.3,512,138.7,512s138.7-62.3,138.7-138.7   s-62.3-138.7-138.7-138.7c-6,0-10.7,4.7-10.7,10.7v64c0,6,4.7,10.7,10.7,10.7c29.4,0,53.4,23.9,53.4,53.4s-23.9,53.4-53.4,53.4   s-53.4-23.9-53.4-53.4V138.5c0-6-4.7-10.7-10.7-10.7H10.7z"/></g></svg>
            Blog
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(app()->view->getSections()['title'] == 'Listing Types')
                                active
                                @endif" href="{{ route('listing-types.index') }}">
            Listing Types
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(app()->view->getSections()['title'] == 'Import')
                                active
                                @endif" href="{{ route('import.index') }}">
            Import
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(app()->view->getSections()['title'] == 'Export')
                                active
                                @endif" href="{{ route('export.index') }}">
            Export
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(app()->view->getSections()['title'] == 'FAQ')
                                active
                                @endif" href="{{ route('faq.index') }}">
            <svg xmlns:dc="http://purl.org/dc/elements/1.1/" width="20" height="20" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" width="38" height="31" viewBox="0 0 38 31" id="Layer_1" xml:space="preserve"><metadata id="metadata3039"><rdf:RDF><cc:Work rdf:about=""><dc:format>image/svg+xml</dc:format><dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"/><dc:title/></cc:Work></rdf:RDF></metadata><defs id="defs3037"/><path fill="currentColor" d="M 5.34375,0 C 2.38475,0 0,2.38575 0,5.34375 l 0,5.34375 c 0,2.197 1.32575,4.08125 3.21875,4.90625 l 0,5.8125 4.8125,-5.34375 0,-5.375 c 0,-4.733 3.8305,-8.5625 8.5625,-8.5625 l 5.71875,0 C 21.3355,0.836 19.8055,0 18.0625,0 L 5.34375,0 z m 11.1875,4.3125 c -3.549,0 -6.4375,2.85825 -6.4375,6.40625 l 0,7.46875 c 0,3.549 2.8895,6.4375 6.4375,6.4375 l 11.90625,0 5.65625,6.375 0,-6.90625 c 2.281,-0.986 3.875,-3.26125 3.875,-5.90625 l 0,-7.46875 c 0,-3.548 -2.85825,-6.40625 -6.40625,-6.40625 l -15.03125,0 z m 7.5,2.40625 c 0.427486,0.00451 0.860926,0.039248 1.28125,0.125 1.683387,0.3537111 3.653225,1.990939 3.65625,4.375 -0.003,2.393137 -1.910063,3.300647 -2.59375,3.75 -0.682523,0.446095 -0.9123,0.984161 -0.90625,1.53125 l 0,2 -2.625,0.03125 0,-3 C 22.84585,14.640224 23.149464,14.020028 24,13.46875 l 1.46875,-1 c 0.937801,-0.639241 0.925047,-1.924289 0.34375,-2.5 C 25.297059,9.4716923 24.424769,9.194189 23.5,9.375 c -1.68106,0.3455667 -1.817619,1.572048 -1.8125,2.75 l 0,0.53125 -2.59375,0 c 0.0047,-2.213488 0.245518,-3.237111 1.40625,-4.5 0.96811,-1.0670684 2.248792,-1.4510477 3.53125,-1.4375 z m -1.1875,12.8125 2.625,0 0,2.6875 -2.625,0 0,-2.6875 z" id="path3033"/></svg>
            FAQ
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(app()->view->getSections()['title'] == 'Refered by')
                                active
                                @endif" href="{{ route('refered_by.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve"><metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon </metadata><g><path fill="currentColor" d="M990,758.8c0,37.8-27.3,68.3-72.4,67.5c-22.6-0.1-20.9,0.4-41.5,0c-36.2-0.8-33.8-22.7-45.6-67.5c-28.9-110.3-151.4-254.7-179.3-271.4c-73.6-44,19.8-14.7,19.8-156.3c0-36.3-8.3-82-23.1-112.7c-11.6-24-21.2-46.3,23.1-44.8c88,2.8,159.4,70.6,159.4,157.5c0,54.6-28,102.6-70.7,130.9c8.3,1.9,16.8,3.9,26.2,6.4C903.1,502.5,990,641.9,990,758.8L990,758.8L990,758.8z M756.6,836c-0.3,36.1-15.9,72.1-77.2,72.1c-138.1-0.1-525.3,0.5-592.2,0C12.4,907.6,10,870.7,10,836c0-166.8,113.8-316.3,266.6-359.3c-67.2-36-100.9-102.8-100.9-180.2c0-112.9,93.1-204.8,207.5-204.8s207.5,91.9,207.5,204.8c0,77.4-36.9,144.2-104.2,180.2C639.5,519.7,758.3,670.7,756.6,836L756.6,836L756.6,836z"/></g></svg>
            Refered by
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Website management</span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link @if(app()->view->getSections()['title'] == 'Pages')
                                active
                                @endif" href="#">
            <svg aria-hidden="true" width="20" height="20" focusable="false" data-prefix="fas" data-icon="pen-fancy" class="svg-inline--fa fa-pen-fancy fa-w-16 fa-1x nav-icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M79.18 282.94a32.005 32.005 0 0 0-20.24 20.24L0 480l4.69 4.69 92.89-92.89c-.66-2.56-1.57-5.03-1.57-7.8 0-17.67 14.33-32 32-32s32 14.33 32 32-14.33 32-32 32c-2.77 0-5.24-.91-7.8-1.57l-92.89 92.89L32 512l176.82-58.94a31.983 31.983 0 0 0 20.24-20.24l33.07-84.07-98.88-98.88-84.07 33.07zM369.25 28.32L186.14 227.81l97.85 97.85 199.49-183.11C568.4 67.48 443.73-55.94 369.25 28.32z"></path></svg>
            Pages
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(app()->view->getSections()['title'] == 'Itinerary info')
                                active
                                @endif" href="#">
            <svg aria-hidden="true" width="20" height="20" focusable="false" data-prefix="fas" data-icon="walking" class="svg-inline--fa fa-walking fa-w-10 fa-1x nav-icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M208 96c26.5 0 48-21.5 48-48S234.5 0 208 0s-48 21.5-48 48 21.5 48 48 48zm94.5 149.1l-23.3-11.8-9.7-29.4c-14.7-44.6-55.7-75.8-102.2-75.9-36-.1-55.9 10.1-93.3 25.2-21.6 8.7-39.3 25.2-49.7 46.2L17.6 213c-7.8 15.8-1.5 35 14.2 42.9 15.6 7.9 34.6 1.5 42.5-14.3L81 228c3.5-7 9.3-12.5 16.5-15.4l26.8-10.8-15.2 60.7c-5.2 20.8.4 42.9 14.9 58.8l59.9 65.4c7.2 7.9 12.3 17.4 14.9 27.7l18.3 73.3c4.3 17.1 21.7 27.6 38.8 23.3 17.1-4.3 27.6-21.7 23.3-38.8l-22.2-89c-2.6-10.3-7.7-19.9-14.9-27.7l-45.5-49.7 17.2-68.7 5.5 16.5c5.3 16.1 16.7 29.4 31.7 37l23.3 11.8c15.6 7.9 34.6 1.5 42.5-14.3 7.7-15.7 1.4-35.1-14.3-43zM73.6 385.8c-3.2 8.1-8 15.4-14.2 21.5l-50 50.1c-12.5 12.5-12.5 32.8 0 45.3s32.7 12.5 45.2 0l59.4-59.4c6.1-6.1 10.9-13.4 14.2-21.5l13.5-33.8c-55.3-60.3-38.7-41.8-47.4-53.7l-20.7 51.5z"></path></svg>
            Itinerary info
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(app()->view->getSections()['title'] == 'User settings')
                                active
                                @endif" href="#">
            <svg aria-hidden="true" width="20" height="20" focusable="false" data-prefix="fas" data-icon="user-cog" class="svg-inline--fa fa-user-cog fa-w-20 fa-1x nav-icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M610.5 373.3c2.6-14.1 2.6-28.5 0-42.6l25.8-14.9c3-1.7 4.3-5.2 3.3-8.5-6.7-21.6-18.2-41.2-33.2-57.4-2.3-2.5-6-3.1-9-1.4l-25.8 14.9c-10.9-9.3-23.4-16.5-36.9-21.3v-29.8c0-3.4-2.4-6.4-5.7-7.1-22.3-5-45-4.8-66.2 0-3.3.7-5.7 3.7-5.7 7.1v29.8c-13.5 4.8-26 12-36.9 21.3l-25.8-14.9c-2.9-1.7-6.7-1.1-9 1.4-15 16.2-26.5 35.8-33.2 57.4-1 3.3.4 6.8 3.3 8.5l25.8 14.9c-2.6 14.1-2.6 28.5 0 42.6l-25.8 14.9c-3 1.7-4.3 5.2-3.3 8.5 6.7 21.6 18.2 41.1 33.2 57.4 2.3 2.5 6 3.1 9 1.4l25.8-14.9c10.9 9.3 23.4 16.5 36.9 21.3v29.8c0 3.4 2.4 6.4 5.7 7.1 22.3 5 45 4.8 66.2 0 3.3-.7 5.7-3.7 5.7-7.1v-29.8c13.5-4.8 26-12 36.9-21.3l25.8 14.9c2.9 1.7 6.7 1.1 9-1.4 15-16.2 26.5-35.8 33.2-57.4 1-3.3-.4-6.8-3.3-8.5l-25.8-14.9zM496 400.5c-26.8 0-48.5-21.8-48.5-48.5s21.8-48.5 48.5-48.5 48.5 21.8 48.5 48.5-21.7 48.5-48.5 48.5zM224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm201.2 226.5c-2.3-1.2-4.6-2.6-6.8-3.9l-7.9 4.6c-6 3.4-12.8 5.3-19.6 5.3-10.9 0-21.4-4.6-28.9-12.6-18.3-19.8-32.3-43.9-40.2-69.6-5.5-17.7 1.9-36.4 17.9-45.7l7.9-4.6c-.1-2.6-.1-5.2 0-7.8l-7.9-4.6c-16-9.2-23.4-28-17.9-45.7.9-2.9 2.2-5.8 3.2-8.7-3.8-.3-7.5-1.2-11.4-1.2h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c10.1 0 19.5-3.2 27.2-8.5-1.2-3.8-2-7.7-2-11.8v-9.2z"></path></svg>
            User settings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(app()->view->getSections()['title'] == 'Policies')
                                active
                                @endif" href="#">
            <svg aria-hidden="true" width="20" height="20" focusable="false" data-prefix="fas" data-icon="gavel" class="svg-inline--fa fa-gavel fa-w-16 fa-1x nav-icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M504.971 199.362l-22.627-22.627c-9.373-9.373-24.569-9.373-33.941 0l-5.657 5.657L329.608 69.255l5.657-5.657c9.373-9.373 9.373-24.569 0-33.941L312.638 7.029c-9.373-9.373-24.569-9.373-33.941 0L154.246 131.48c-9.373 9.373-9.373 24.569 0 33.941l22.627 22.627c9.373 9.373 24.569 9.373 33.941 0l5.657-5.657 39.598 39.598-81.04 81.04-5.657-5.657c-12.497-12.497-32.758-12.497-45.255 0L9.373 412.118c-12.497 12.497-12.497 32.758 0 45.255l45.255 45.255c12.497 12.497 32.758 12.497 45.255 0l114.745-114.745c12.497-12.497 12.497-32.758 0-45.255l-5.657-5.657 81.04-81.04 39.598 39.598-5.657 5.657c-9.373 9.373-9.373 24.569 0 33.941l22.627 22.627c9.373 9.373 24.569 9.373 33.941 0l124.451-124.451c9.372-9.372 9.372-24.568 0-33.941z"></path></svg>
            Policies
            </a>
          </li>
        </ul>
    @endcan
        <ul class="nav flex-column mt-4">
            <li class="nav-item">
              <a class="nav-link px-3" href="/telescope">
                Telescope
              </a>
            </li>
        </ul>
      </div>
   </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pl-to-menu">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ app()->view->getSections()['title'] }}</h1>
      </div>

    @if ( session('success') )
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    @if ( session('danger') )
      <div class="alert alert-danger">
        {{ session('danger') }}
      </div>
    @endif

      @yield('content')
    </main>
  </div>
</div>


    <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
