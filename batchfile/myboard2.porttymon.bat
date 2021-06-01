
	

	c: 

	cd C:\\xampp\\htdocs\\portty\\exe 

	rem del /q /f myboard2.output 

	cd ..
	rem timeout /t 5 /nobreak
	porttymon.exe myboard2 com10 3 

	pause
	