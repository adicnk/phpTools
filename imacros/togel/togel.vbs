Option Explicit
dim rs, iim1, mySQL
dim scriptName, scriptPath, connstring
dim iret
dim a,b,c,d
dim var1,var2,var3,var4
dim message 

message = "This script demonstrates how to read data from a website content into mySQL database" + VbCrLf + VbCrLf + VbCrLf
message = message + "Enjoy it !"
MsgBox (message)

scriptName = WScript.ScriptFullName
scriptPath = Left(scriptName, InstrRev(scriptName, "\"))

'MsgBox (scriptName) 'This script filename
'MsgBox (scriptPath) 'This script path of the filename

'Setting up mySQL Database
set rs = CreateObject("ADODB.Connection")
connstring = "DRIVER={MySQL ODBC 8.0 Unicode Driver};"_
	& "SERVER=localhost;"_
	& "DATABASE=togel;"_
	& "UID=root;PWD=; OPTION=3"	
rs.Open (connstring)

'Create object of imacros
set iim1= CreateObject ("imacros")
iret = iim1.iimOpen("")
iret = iim1.iimDisplay("Submitting Data from Web to MySQL")

a = 1 'Default is 1
iret = iim1.iimDisplay("Get Tanggal & Number, Please Wait !")	
	
DO UNTIL a=21
	b = a -1
	iret = iim1.iimSet("VAR1", a)
	
	if a = 1 then
		iret = iim1.iimSet("VAR2", 2)
		iret = iim1.iimSet("VAR3", 3)
		iret = iim1.iimSet("VAR4", 4)
	else
		iret = iim1.iimSet("VAR2", 2+4*b)
		iret = iim1.iimSet("VAR3", 3+4*b)
		iret = iim1.iimSet("VAR4", 4+4*b)
	end if	
		
	iret = iim1.iimPlay("C:\Users\Dev Inc\Documents\iMacros\Macros\" & "nomor.iim")
   
	'Get the variable from Web
	var1 = iim1.iimGetExtract(1)
	var2 = iim1.iimGetExtract(3)
	var3 = iim1.iimGetExtract(5)
	var4 = iim1.iimGetExtract(7)
	
	'Saving Data to mySQL
'	mySQL = "INSERT INTO nomor (kota_id,tanggal,angka) VALUES (1,'" & var1 & "','" & var2 & "')"
'	rs.Execute(mySQL)

'	mySQL = "INSERT INTO nomor (kota_id,tanggal,angka) VALUES (2,'" & var1 & "','" & var3 & "')"
'	rs.Execute(mySQL)

'	mySQL = "INSERT INTO nomor (kota_id,tanggal,angka) VALUES (3,'" & var1 & "','" & var4 & "')"
'	rs.Execute(mySQL)
	
	'saving another table
'	mySQL = "INSERT INTO nomer (tanggal,sdy,sgp,hk) VALUES ('" & var1 & "','" & var2 & "','" & var3 & "','" & var4 & "')"
'	rs.Execute(mySQL)

	mySQL = "INSERT INTO updated (tanggal,sdy,sgp,hk) VALUES ('" & var1 & "','" & var2 & "','" & var3 & "','" & var4 & "')"
	rs.Execute(mySQL)
	
	a = a + 1
LOOP

iim1.iimClose(30)
WScript.Quit(iret)