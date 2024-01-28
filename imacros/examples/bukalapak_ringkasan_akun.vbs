Option Explicit
dim cn, rs, iim1, mySQL, connstring
dim scriptName, scriptPath
dim iret
dim char1, char2, i
dim surah_index
dim message
dim account_id

message = "This script demonstrates how to read data from a website content into mySQL database and vice versa" + VbCrLf + VbCrLf + VbCrLf
message = message + "Enjoy it !"
MsgBox (message)

scriptName = WScript.ScriptFullName
scriptPath = Left(scriptName, InstrRev(scriptName, "\"))

'MsgBox (scriptName) 'This script filename
'MsgBox (scriptPath) 'This script path of the filename

'Setting up mySQL Database
set cn = CreateObject("ADODB.Connection")
connstring = "DRIVER={MySQL ODBC 8.0 Unicode Driver};"_
	& "SERVER=localhost;"_
	& "DATABASE=dropship;"_
	& "UID=root;PWD=qbidb; OPTION=3"	
cn.Open (connstring)

'Create object of imacros
set iim1= CreateObject ("imacros")
iret = iim1.iimOpen("")
iret = iim1.iimDisplay("Submitting Data from MySQL to Web")

'Create the recordset for record operation
set rs = CreateObject("ADODB.Recordset")

mySQL = "SELECT * FROM account WHERE marketplace_id=1 ORDER BY id DESC"
rs.Open mySQL, cn
account_id = 1

'If no record this command become error and continue to the next command and account_id = 1
On Error Resume Next 
account_id = rs.Fields(0).value + 1

iret = iim1.iimDisplay("Wait for Ringkasan Akun")
iret = iim1.iimPlay("C:\Users\Y.S Riyadi\OneDrive\Documents\iMacros\Macros\" & "BukalapakRingkasanAkun.iim")

if iret = 1 then
	mySQL = "INSERT INTO account(marketplace_id, name, logo, url, email, telp, address, " _
		& "bukadompet_saldo, bukadompet_pending_topup, bukadompet_pending_withdrawal, credit_saldo, credit_pending_topup, " _
		& "feedback_positive, feedback_negative, investasi_bukaemas, push_residu, push_promote_residu) " _
		& "VALUES (1,'" & iim1.iimGetExtract(1) & "', 'logo.jpg', '" & iim1.iimGetExtract(2) & "','" & iim1.iimGetExtract(3) & "'"_
		& ",'" & iim1.iimGetExtract(4) & "','" & iim1.iimGetExtract(5) & "','" & Replace(iim1.iimGetExtract(6), chr(46),"") & "','" & iim1.iimGetExtract(7) & "'" _
		& ",'" & iim1.iimGetExtract(8) & "','" & iim1.iimGetExtract(9) & "','" & iim1.iimGetExtract(10) & "','" & iim1.iimGetExtract(11) & "'" _
		& ",'" & iim1.iimGetExtract(12) & "','" & Replace(Replace(iim1.iimGetExtract(13),"Rp",""),chr(44),chr(46)) & "'," & iim1.iimGetExtract(14) & "," & iim1.iimGetExtract(15) _
		& ")"
	MsgBox (mySQL)		
	cn.Execute(mySQL)
		
	mySQL = "INSERT INTO account_transaction(account_id, marketplace_id, selling, selling_7days, selling_lastmonth, total_selling_7days, total_selling_lastmonth, " _
		& "diskusi_retur, bill, buying, item_selling, item_not_selling, item_favorite) " _
		& "VALUES (" & account_id & ",1,'" & iim1.iimGetExtract(16) & "','" & iim1.iimGetExtract(17) & "','" & iim1.iimGetExtract(18) & "','" & iim1.iimGetExtract(19) & "'" _
		& ",'" & iim1.iimGetExtract(20) & "','" & iim1.iimGetExtract(21) & "','" & iim1.iimGetExtract(22) & "','" & iim1.iimGetExtract(23) & "'" _
		& ",'" & iim1.iimGetExtract(24) & "','" & iim1.iimGetExtract(25) & "','" & iim1.iimGetExtract(26) & "'" _
		& ")"
	MsgBox (mySQL)
	cn.Execute(mySQL)
	
	iim1.iimClose(30)
	WScript.Quit(iret)
else 
	MsgBox("An error occur during execution")
end if