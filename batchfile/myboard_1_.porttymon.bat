
	

	c: 

	cd C:\\xampp\\htdocs\\portty\\exe\\conf 

	rem del /q /f myboard_1_.output 

	cd ..
	rem timeout /t 5 /nobreak
	porttymon.exe myboard_1_ com10 3 

	pause
	