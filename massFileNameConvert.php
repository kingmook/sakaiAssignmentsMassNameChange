<?php
/*Scan an unzipped Download All from Sakai's Assignments tool, move all student submission to a single folder, and append 
the student code based on folder name to each submitted file 

Working directories:
unzipAssignmentMass - where you put the unzipped export from the Sakai assignments tool
renamedFiles - where the output from the renaming is temporarily stored
*/

//Config Starts (make your changes here as needed)

//Append to the folder structure (if there is a name of the unzipped folder)
$unzippedFolderName = "Essay";

//Name of the zip you'd like to create
$zippedFolderName = "ITAL-1P96-D02-S01-LEC.zip";


//Config Ends (no changey)
/*--------------------------------*/

//Get all the subfolder in unZipAssignmentMass
$folderStruct = scandir("unzipAssignmentMass/Essay");

//Get rid of the first two entries in the array (linux . & ..)
unset($folderStruct[0]);
unset($folderStruct[1]);

//Traverse for each folder (ie student)
foreach($folderStruct as $folderName){

	//Find all the files in each student folder
	$files = scandir("unzipAssignmentMass/".$unzippedFolderName."/".$folderName."/Submission attachment(s)");

	//Get rid of the first two entries in the array (linux . & ..)
	unset($files[0]);
	unset($files[1]);

	//For each individual file move it to the big renamedFiles folder and actually append the username
	foreach($files as $fileName){
		
		//The source file from the Mass Download Folder
		$srcFile = "./unzipAssignmentMass/".$unzippedFolderName."/".$folderName."/Submission attachment(s)/".$fileName;

		//The file with it's new name into the renamedFiles
		$dstFile = "./renamedFiles/".$folderName."--".$fileName;

		//Try and actually copy the file and output what happened
		if (!copy($srcFile, $dstFile)) {
		    echo "Failed to copy: ".$fileName."<br />";
		}
		else{
			echo "Successfully copied: ".$fileName."<br />";
		}

	}

}

//Zip all the files up
exec('zip -j '.getcwd().'/'.$zippedFolderName.' '.getcwd().'/renamedFiles/*');

//Clear out the renamedFiles & the unzipAssignmentMass folders
exec('rm -rf '.getcwd().'/renamedFiles/*');
exec('rm -rf '.getcwd().'/unzipAssignmentMass/*');

//Tell the user we did it
echo '<strong>Zip file called '.$zippedFolderName.' created in folder root. All other working directories cleared of data.</strong>';