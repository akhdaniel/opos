c:\windows\system32\wget -O c:\windows\temp\wget.txt "http://localhost/opos/order/recreateUnpostedOeOrders?cron=1&limit=10"
exit
rem jalankan di stask scheduler: %comspec% /c start "" /min "C:\xampp\htdocs\opos\db\cron.bat"