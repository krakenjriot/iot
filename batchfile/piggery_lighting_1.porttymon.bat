
	

	c: 

	cd C:\\xampp\\htdocs\\portty\\exe\\conf 

	rem del /q /f piggery_lighting_1.output 

	cd ..
	rem timeout /t 5 /nobreak
	porttymon.exe piggery_lighting_1 com10 3 

	pause
	