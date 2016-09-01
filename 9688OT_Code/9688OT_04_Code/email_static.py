import smtplib, os
from email.MIMEMultipart import MIMEMultipart
from email.MIMEBase import MIMEBase
from email.MIMEText import MIMEText
from email.Utils import COMMASPACE, formatdate
from email import Encoders
from subprocess import call

# Define email fields
send_to = ['whoever@account.com']
send_from = 'your_address@account.com';
subject = 'Test email'
text = 'This is a test email for sending email attachments'
outfile = 'chart.png'

# Render our chart
call(['phantomjs', 'highcharts-convert.js', '-infile', 'options.json', '-outfile', outfile])

# Set email fields
msg = MIMEMultipart()
msg['From'] = send_from
msg['To'] = COMMASPACE.join(send_to)
msg['Date'] = formatdate(localtime=True)
msg['Subject'] = subject
msg.attach( MIMEText(text) )

# Attach the generated chart
part = MIMEBase('application', "octet-stream")
part.set_payload( open(outfile,"rb").read() )
Encoders.encode_base64(part)
part.add_header('Content-Disposition', 'attachment; filename="%s"' % os.path.basename(outfile))
msg.attach(part)

# Send email
smtp = smtplib.SMTP('smtp.gmail.com:587')  
smtp.starttls()  
smtp.login('gmail_username@gmail.com','your password')  
smtp.sendmail(send_from, send_to, msg.as_string())
smtp.quit()

