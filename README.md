# sakaiAssignmentsMassNameChange
*A tool to download Sakai assignments submissions and change the file names enmasse.*

Scan an unzipped Download All from Sakai's Assignments tool, move all student submission to a single folder, and append 
the student code based on folder name to each submitted file.

Primarily used to upload large groups of files to Turnitin.com but ensure you know whos assignment1.docx is whos.

Working directories:
* unzipAssignmentMass - where you put the unzipped export from the Sakai assignments tool
* renamedFiles - where the output from the renaming is temporarily stored
