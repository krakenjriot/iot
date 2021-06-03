
	

	c: 

	cd C:\\xampp\\htdocs\\portty\\exe\\conf 

	rem del /q /f myboard1_home_place_#2.output 

	cd ..
	rem timeout /t 5 /nobreak
	porttymon.exe myboard1_home_place_#2 com11 3 

	pause
	