
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
  rel="apple-touch-icon"
  sizes="76x76"
  href="{{ asset('assets/img/apple-icon.png') }}" />
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />
  <title>@yield('title', 'Login')</title>
  @yield('header')
  <link
  href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
  rel="stylesheet" />
  <script
  src="https://kit.fontawesome.com/42d5adcbca.js"
  crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <script src="https://unpkg.com/@popperjs/core@2') }}"></script>
  <link
  href="{{ asset('assets/css/soft-ui-dashboard-tailwind.css?v=1.0.5') }}"
  rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <script
  defer
  data-site="YOUR_DOMAIN_HERE"
  src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
  <style>
    .bg-green-100{
      background-color: green;
      color: white;
    }
    .bg-yellow-100
    {
     background-color: yellow;
     color: black;
   }.bg-red-100{
     background-color: darkred;
     color: white;
   }
 </style>
</head>

<body
class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
<!-- sidenav  -->

@include('layouts.menu')
<!-- end sidenav -->

<main
class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
<!-- Navbar -->
<nav
class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start"
navbar-main
navbar-scroll="true">
<div
class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
<nav>
  <!-- breadcrumb -->
  <ol
  class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
  <li class="text-sm leading-normal">
    <a class="opacity-50 text-slate-700" href="javascript:;"
    >Pages</a
    >
  </li>
  <li
  class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
  aria-current="page">
  @yield('title')
</li>
</ol>
<h6 class="mb-0 font-bold capitalize">@yield('title')</h6>
</nav>
<div
class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
<div class="flex items-center md:ml-auto md:pr-4">
<span class="h-full bg-gradient-to-tl from-purple-700 to-pink-500 rounded-xl" style="padding-bottom:5px;padding-top:5px;padding-left:10px;padding-right:10px;color:white;border-radius:50px;max-width: 200px;" title="{{ auth()->user()->name }}">
    <b>{{ auth()->user()->name }}</b>
</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


  <div
  class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
  <span
  class="text-sm ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
  <i class="fas fa-search"></i>
</span>
<input
type="text"
class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
placeholder="Type here..." />
</div>
</div>
<ul
class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
<li class="flex items-center pl-4 xl:hidden">
  <a
  href="javascript:;"
  class="block p-0 text-sm transition-all ease-nav-brand text-slate-500"
  sidenav-trigger>
  <div class="w-4.5 overflow-hidden">
    <i
    class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
    <i
    class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
    <i
    class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
  </div>
</a>
</li>
<li class="flex items-center px-4">
  <a
  href="javascript:;"
  class="p-0 text-sm transition-all ease-nav-brand text-slate-500">
  <i
  fixed-plugin-button-nav
  class="cursor-pointer fa fa-cog"></i>
  <!-- fixed-plugin-button-nav  -->
</a>
</li>

<!-- notifications -->

<li class="relative flex items-center pr-2">
  <p class="hidden transform-dropdown-show"></p>
  <a
  href="javascript:;"
  class="block p-0 text-sm transition-all ease-nav-brand text-slate-500"
  dropdown-trigger
  aria-expanded="false">
  <i class="cursor-pointer fa fa-bell"></i>
</a>

<ul
dropdown-menu
class="text-sm transform-dropdown before:font-awesome before:leading-default before:duration-350 before:ease-soft lg:shadow-soft-3xl duration-250 min-w-44 before:sm:right-7.5 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all before:content-['\f0d8'] sm:-mr-6 lg:absolute lg:right-0 lg:left-auto lg:mt-2 lg:block lg:cursor-pointer">
<!-- add show class on dropdown open js -->
<li class="relative mb-2">
  <a
  class="ease-soft py-1.2 clear-both block w-full whitespace-nowrap rounded-lg bg-transparent px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors"
  href="javascript:;">
  <div class="flex py-1">
    <div class="my-auto">
      <img
      src="{{ asset('assets/img/team-2.jpg') }}"
      class="inline-flex items-center justify-center mr-4 text-sm text-white h-9 w-9 max-w-none rounded-xl" />
    </div>
    <div class="flex flex-col justify-center">
      <h6 class="mb-1 text-sm font-normal leading-normal">
        <span class="font-semibold">New message</span> from
        Laur
      </h6>
      <p class="mb-0 text-xs leading-tight text-slate-400">
        <i class="mr-1 fa fa-clock"></i>
        13 minutes ago
      </p>
    </div>
  </div>
</a>
</li>

<li class="relative mb-2">
  <a
  class="ease-soft py-1.2 clear-both block w-full whitespace-nowrap rounded-lg px-4 transition-colors duration-300 hover:bg-gray-200 hover:text-slate-700"
  href="javascript:;">
  <div class="flex py-1">
    <div class="my-auto">
      <img
      src="{{ asset('assets/img/small-logos/logo-spotify.svg') }}"
      class="inline-flex items-center justify-center mr-4 text-sm text-white bg-gradient-to-tl from-gray-900 to-slate-800 h-9 w-9 max-w-none rounded-xl" />
    </div>
    <div class="flex flex-col justify-center">
      <h6 class="mb-1 text-sm font-normal leading-normal">
        <span class="font-semibold">New album</span> by
        Travis Scott
      </h6>
      <p class="mb-0 text-xs leading-tight text-slate-400">
        <i class="mr-1 fa fa-clock"></i>
        1 day
      </p>
    </div>
  </div>
</a>
</li>

<li class="relative">
  <a
  class="ease-soft py-1.2 clear-both block w-full whitespace-nowrap rounded-lg px-4 transition-colors duration-300 hover:bg-gray-200 hover:text-slate-700"
  href="javascript:;">
  <div class="flex py-1">
    <div
    class="inline-flex items-center justify-center my-auto mr-4 text-sm text-white transition-all duration-200 ease-nav-brand bg-gradient-to-tl from-slate-600 to-slate-300 h-9 w-9 rounded-xl">
    <svg
    width="12px"
    height="12px"
    viewBox="0 0 43 36"
    version="1.1"
    xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink">
    <title>credit-card</title>
    <g
    stroke="none"
    stroke-width="1"
    fill="none"
    fill-rule="evenodd">
    <g
    transform="translate(-2169.000000, -745.000000)"
    fill="#FFFFFF"
    fill-rule="nonzero">
    <g
    transform="translate(1716.000000, 291.000000)">
    <g
    transform="translate(453.000000, 454.000000)">
    <path
    class="color-background"
    d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
    opacity="0.593633743"></path>
    <path
    class="color-background"
    d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
  </g>
</g>
</g>
</g>
</svg>
</div>
<div class="flex flex-col justify-center">
  <h6 class="mb-1 text-sm font-normal leading-normal">
    Payment successfully completed
  </h6>
  <p class="mb-0 text-xs leading-tight text-slate-400">
    <i class="mr-1 fa fa-clock"></i>
    2 days
  </p>
</div>
</div>
</a>
</li>
</ul>
</li>
</ul>
</div>
</div>
</nav>

<!-- end Navbar -->

<!-- cards -->
@yield('content')

<footer class="pt-4">

</footer>
</div>
<!-- end cards -->
</main>
<div fixed-plugin>
  <a
  fixed-plugin-button
  class="bottom-7.5 right-7.5 text-xl z-990 shadow-soft-lg rounded-circle fixed cursor-pointer bg-white px-4 py-2 text-slate-700">
  <i class="py-2 pointer-events-none fa fa-cog"> </i>
</a>
<!-- -right-90 in loc de 0-->
<div
fixed-plugin-card
class="z-sticky shadow-soft-3xl w-90 ease-soft -right-90 fixed top-0 left-auto flex h-full min-w-0 flex-col break-words rounded-none border-0 bg-white bg-clip-border px-2.5 duration-200">
<div class="px-6 pt-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
  <div class="float-left">
    <h5 class="mt-4 mb-0">Soft UI Configurator</h5>
    <p>See our dashboard options.</p>
  </div>
  <div class="float-right mt-6">
    <button
    fixed-plugin-close-button
    class="inline-block p-0 mb-4 text-xs font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer hover:scale-102 leading-pro ease-soft-in tracking-tight-soft bg-150 bg-x-25 active:opacity-85 text-slate-700">
    <i class="fa fa-close"></i>
  </button>
</div>
<!-- End Toggle Button -->
</div>
<hr
class="h-px mx-0 my-1 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />
<div class="flex-auto p-6 pt-0 sm:pt-4">
  <!-- Sidebar Backgrounds -->
  <div>
    <h6 class="mb-0">Sidebar Colors</h6>
  </div>
  <a href="javascript:void(0)">
    <div class="my-2 text-left" sidenav-colors>
      <span
      class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-purple-700 to-pink-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-slate-700 text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
      active-color
      data-color-from="purple-700"
      data-color-to="pink-500"
      onclick="sidebarColor(this)"></span>
      <span
      class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-gray-900 to-slate-800 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
      data-color-from="gray-900"
      data-color-to="slate-800"
      onclick="sidebarColor(this)"></span>
      <span
      class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-blue-600 to-cyan-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
      data-color-from="blue-600"
      data-color-to="cyan-400"
      onclick="sidebarColor(this)"></span>
      <span
      class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-green-600 to-lime-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
      data-color-from="green-600"
      data-color-to="lime-400"
      onclick="sidebarColor(this)"></span>
      <span
      class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-red-500 to-yellow-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
      data-color-from="red-500"
      data-color-to="yellow-400"
      onclick="sidebarColor(this)"></span>
      <span
      class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-red-600 to-rose-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
      data-color-from="red-600"
      data-color-to="rose-400"
      onclick="sidebarColor(this)"></span>
    </div>
  </a>
  <!-- Sidenav Type -->
  <div class="mt-4">
    <h6 class="mb-0">Sidenav Type</h6>
    <p class="text-sm leading-normal">
      Choose between 2 different sidenav types.
    </p>
  </div>
  <div class="flex">
    <button
    transparent-style-btn
    class="inline-block w-full px-4 py-3 mb-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border border-transparent border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-purple-700 to-pink-500 bg-fuchsia-500 hover:border-fuchsia-500"
    data-class="bg-transparent"
    active-style>
    Transparent
  </button>
  <button
  white-style-btn
  class="inline-block w-full px-4 py-3 mb-2 ml-2 text-xs font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500"
  data-class="bg-white">
  White
</button>
</div>
<p class="block mt-2 text-sm leading-normal xl:hidden">
  You can change the sidenav type just on desktop view.
</p>
<!-- Navbar Fixed -->
<div class="mt-4">
  <h6 class="mb-0">Navbar Fixed</h6>
</div>
<div class="min-h-6 mb-0.5 block pl-0">
  <input
  navbarFixed
  class="rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
  type="checkbox" />
</div>
<hr
class="h-px bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent sm:my-6" />

<a
class="inline-block w-full px-6 py-3 mb-4 text-xs font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:shadow-soft-xs hover:scale-102 active:opacity-85 leading-pro ease-soft-in tracking-tight-soft bg-150 bg-x-25 border-slate-700 text-slate-700 hover:bg-transparent hover:text-slate-700 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-slate-700 active:hover:shadow-none"
href="https://www.creative-tim.com/learning-lab/tailwind/html/quick-start/soft-ui-dashboard/"
target="_blank"
>View documentation</a
>
<div class="w-full text-center">
  <a
  class="github-button"
  href="https://github.com/creativetimofficial/soft-ui-dashboard-tailwind"
  data-icon="octicon-star"
  data-size="large"
  data-show-count="true"
  aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub"
  >Star</a
  >
  <h6 class="mt-4">Thank you for sharing!</h6>
  <a
  href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20Tailwind%20made%20by%20%40CreativeTim&hashtags=webdesign,dashboard,tailwindcss&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard-tailwind"
  class="inline-block px-6 py-3 mb-0 mr-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:shadow-soft-xs hover:scale-102 active:opacity-85 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700"
  target="_blank">
  <i class="mr-1 fab fa-twitter"></i> Tweet
</a>
<a
href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard-tailwind"
class="inline-block px-6 py-3 mb-0 mr-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:shadow-soft-xs hover:scale-102 active:opacity-85 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700"
target="_blank">
<i class="mr-1 fab fa-facebook-square"></i> Share
</a>
</div>
</div>
</div>
</div>
</body>
@yield('footer')
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}" async></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}" async></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script
src="{{ asset('assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5') }}"
async></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</html>
