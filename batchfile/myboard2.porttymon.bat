
	

	c: 

	cd C:\\xampp\\htdocs\\portty\\exe\\conf 

	rem del /q /f myboard2.output 

	cd ..
	rem timeout /t 5 /nobreak
	porttymon.exe myboard2 com10 9 

	pause
	