
	

	c: 

	cd C:\\xampp\\htdocs\\portty\\exe\\conf 

	rem del /q /f myboard1.output 

	cd ..
	rem timeout /t 5 /nobreak
	porttymon.exe myboard1 com10 3 

	pause
	