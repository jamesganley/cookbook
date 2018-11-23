<?php
require __DIR__ . '/../vendor/autoload.php';
use Aws\S3\S3Client;
        	use Aws\S3\Exception\S3Exception;
        	// AWS Info
        	$bucketName = 'cookbook-strawberry';
        	$IAM_KEY = 'AKIAIPEP6LNO77KYTAFA';
        	$IAM_SECRET = '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';
        	// Connect to AWS
        	try {
        		// You may need to change the region. It will say in the URL when the bucket is open
        		// and on creation.
        		$s3 = S3Client::factory(
        			array(
        				'credentials' => array(
        					'key' => $IAM_KEY,
        					'secret' => $IAM_SECRET
        				),
        				'version' => 'latest',
        				'region'  => 'eu-west-1'
        			)
        		);
        	} catch (Exception $e) {
        		// We use a die, so if this fails. It stops here. Typically this is a REST call so this would
        		// return a json object.
        		die("Error:0 " . $e->getMessage());
        	}

        	// For this, I would generate a unqiue random string for the key name. But you can do whatever.
        	$keyName = "images/" . basename($_FILES["fileToUpload"]['name']);
        	$pathInS3 = 'https://s3.eu-west-1.amazonaws.com/' . $bucketName . '/' . $keyName;
        	// Add it to S3
        	try {
        		// Uploaded:
            $target_dir= $_SERVER["DOCUMENT_ROOT"] . "/static/images/";

        		$file = $target_dir.basename( $_FILES["fileToUpload"]['name']);
        		$s3->putObject(
        			array(
        				'Bucket'=>$bucketName,
        				'Key' =>  $keyName,
        				'SourceFile' => $file,
        				'StorageClass' => 'REDUCED_REDUNDANCY'
        			)
        		);
        	} catch (S3Exception $e) {
        		die('Error:1' . $e->getMessage());
        	} catch (Exception $e) {
        		die('Error:2' . $e->getMessage());
        	}
        	echo 'Done uploading ';
        	// Now that you have it working, I recommend adding some checks on the files.
        	// Example: Max size, allowed file types, etc.
        ?>
