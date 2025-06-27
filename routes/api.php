<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\authController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardMetrologiController;
use App\Http\Controllers\AdminIndustriController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DirectoryBookController;
use App\Http\Controllers\DataIKMController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\PersuratanController;
use App\Http\Controllers\dashboardPerdaganganController;
use App\Http\Controllers\PelaporanPenyaluranController;
use App\Http\Controllers\SobatHargaController;
use App\Http\Controllers\KabidPerdaganganController;
use App\Http\Middleware\UserAuthMiddleware;
use App\Http\Middleware\RoleCheckMiddleware;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\KabidIndustriController;
use App\Http\Controllers\UserHalalController;
use App\Http\Controllers\HalalController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\ForumDiskusiController;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\KadisController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\Auth\LupaPasswordController;
use App\Mail\RegisterVerificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;

//Perdagangan


//Industri


//Metrologi