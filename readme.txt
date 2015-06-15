Readme

halaman di bagi menjadi 3:


1. hal. admin platform
	- url: http://localhost/sweeto.com/adminsw370
	- login =	u: s_adminsweeto	p: 1qaz212
	- Template hal ini mengikuti params di tbl. global_option
	- menu-menu yg ada di back office dan public di setting di hal. ini
	- pengaturan halaman kelola template untuk template public di tetapkan di hal.ini atau di hal. back office juga

2. hal. back office aplikasi
	- url: http://localhost/sweeto.com/backoffic3
	- login =	u: admin_bo	p: 1qaz212
	- Template hal ini mengikuti params di tbl. global_option
	- segala input form input attribute (field) di atur di hal. admin platform melalui paramsnya
	- hak akses menu di atur di di hal. admin platform (srbac)
	

3. hal. public
	

* 	jika login sbg super admin sweeto(s_adminsweeto) di redirect ke hal. admin platform, 
	jika tidak di redirect ke hal. back office

	
	
//untuk content: dibagi menjadi 2 bagian, content statik dan konten dinamis

Widget

Ada 3 tipe widget:
1. dinamis => isi widget di ambil dari database
2. static  => widget di panggil dari file langsung
3. module  => widget di panggil dari file langsung, tetapi merupakan bagian dari module

Contoh struktur widget zip:

nama_widget_typewidget.zip => Banner_static.zip
-- NamaWidget.php
-- NamaWidget.yaml
-- views
   -- nama_widget.php

