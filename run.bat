@echo off
title Ustadzah AI - PHP Web Server
color 0B

echo =======================================================
echo          MENJALANKAN SERVER LOKAL PHP
echo =======================================================
echo Server akan berjalan di http://localhost:8000
echo Membuka browser secara otomatis...
echo.
echo Untuk mematikan server, tekan CTRL + C di jendela ini.
echo =======================================================

:: Membuka browser default ke localhost:8000
start http://localhost:8000

:: Menjalankan PHP built-in server di folder saat ini (sebagai root web)
php -S localhost:8000

pause
