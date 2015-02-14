<%
'Edit these setting for your SMTP server/account

'smtp.gmail.com
smtpServer = "" 
'465
smtpPort = 
'myemail@gmail.com
smtpAccount = ""
smtpPasswd = ""
'redirect back to contact form or home page
redirectPage = "../index.php?msgsent=thankyou#contact"
'if an error occurs
errorPage = "../index.php?msgsent=error#contact"






'sendmail
'check for empty fields
if (Request.ServerVariables("REQUEST_METHOD")= "POST" AND request.form("sendToEmail")>"" AND instr(request.form("email"),"@")>0 AND request.form("name")>"" AND request.form("phone")>"" AND request.form("message")>"") then
	Set objMail=CreateObject("CDO.Message")
		objMail.Subject="Contact Form - "&request.form("name") &""
		objMail.From="noreply@"&Request.ServerVariables("SERVER_NAME")&""
		objMail.ReplyTo="noreply@"&Request.ServerVariables("SERVER_NAME")&""
		objMail.To=""&request.form("sendToEmail") &""
		objMail.TextBody="From - "&request.form("name") &"" &vbCrLf &vbCrLf &_
						"Referer: "&Request.ServerVariables ("HTTP_REFERER")&"" &vbCrLf &vbCrLf &_
						"Name: "&request.form("name") &"" &vbCrLf &vbCrLf &_
						"Email: "&request.form("email") &"" &vbCrLf &vbCrLf &_
						"Phone: "&request.form("phone") &"" &vbCrLf &vbCrLf &_
						"Message: "&request.form("message") &"" &vbCrLf &vbCrLf &_
						"Sent from IP Address: "&Request.ServerVariables("remote_addr")&"" &vbCrLf &vbCrLf &_
						"Server Time: "&now()
		objMail.Configuration.Fields.Item("http://schemas.microsoft.com/cdo/configuration/sendusing") = 2
		objMail.Configuration.Fields.Item("http://schemas.microsoft.com/cdo/configuration/smtpserver") = smtpServer
		objMail.Configuration.Fields.Item("http://schemas.microsoft.com/cdo/configuration/smtpconnectiontimeout") = 60
		objMail.Configuration.Fields.Item("http://schemas.microsoft.com/cdo/configuration/smtpusessl") = 1
		objMail.Configuration.Fields.Item("http://schemas.microsoft.com/cdo/configuration/smtpserverport") = smtpPort
		objMail.Configuration.Fields.Item("http://schemas.microsoft.com/cdo/configuration/sendusername") = smtpAccount
		objMail.Configuration.Fields.Item("http://schemas.microsoft.com/cdo/configuration/sendpassword") = smtpPasswd
		objMail.Configuration.Fields.Item("http://schemas.microsoft.com/cdo/configuration/smtpauthenticate") = 1
		objMail.Configuration.Fields.Update
		objMail.Send
	set objMail=nothing
else
	response.redirect(errorPage)
end if
response.redirect(redirectPage)
%>