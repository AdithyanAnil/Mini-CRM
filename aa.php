<?php
session_start();
include "connect.php";

?>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />

<div class="bg-orange-100 min-h-screen">
  <div class="fixed bg-white text-blue-800 px-10 py-1 z-10 w-full">
      <div class="flex items-center justify-between py-2 text-5x1">
        <div class="font-bold text-blue-900 text-xl"><?php
            echo $_SESSION['name'];
            ?><span class="text-orange-600">(Staff)</span></div>
        <div class="flex items-center text-gray-500">
          <span class="material-icons-outlined p-2" style="font-size: 30px">search</span>
          <span class="material-icons-outlined p-2" style="font-size: 30px">notifications</span>
          <div class="bg-center bg-cover bg-no-repeat rounded-full inline-block h-12 w-12 ml-2" style="background-image: url(https://i.pinimg.com/564x/de/0f/3d/de0f3d06d2c6dbf29a888cf78e4c0323.jpg)"></div>
        </div>
    </div>
  </div>
  
  <div class="flex flex-row pt-24 px-10 pb-4">
    <div class="w-2/12 mr-6">
      

      <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
      <p class="bg-rose-600 w-full font-bold text-lg text-center text-white">Manage Customers</p>

        <a href="add_cus.php" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">face</span>
          Add Customer
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="view_cus.php" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">settings</span>
          View Customer
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="update_cus.php" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">tune</span>
          Update/Delete
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="bulk.php" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">tune</span>
          Add bulk
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
      </div>

      <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
      <a href="logout.php?" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">power_settings_new</span>
          Log out
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
    </div>
    </div>