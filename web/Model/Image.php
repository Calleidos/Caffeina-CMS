<?php
App::uses('AppModel', 'Model');
App::import('Vendor', 'Uploader.Uploader');
/**
 * Image Model
 *
 * @property Document $Document
 */
class Image extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	
	
	
	public $actsAs = array( 
		'Uploader.Attachment' => array(
			'fileName' => array(
				'name'		=> 'formatFileName',		// Name of the function to use to format filenames
				'baseDir'	=> WWW_ROOT,				// See UploaderComponent::$baseDir
				'uploadDir'	=> 'files/uploads/images',	// See UploaderComponent::$uploadDir
				'dbColumn'	=> 'uploadPath',			// The database column name to save the path to
				'importFrom'	=> '',					// Path or URL to import file
				'defaultPath'	=> '',					// Default file path if no upload present
				'maxNameLength'	=> 30,					// Max file name length
				'overwrite'	=> true,					// Overwrite file with same name if it exists
				'stopSave'	=> true,					// Stop the model save() if upload fails
				'allowEmpty'	=> false,				// Allow an empty file upload to continue
				'transforms' => array(					// What transformations to do on images: scale, resize, etc
					array('method' => 'resize', 'height' => 100, 'dbColumn' => 'path_scaled') // Removes original image and uses this one instead
				),
				's3'		=> array(),					// Array of Amazon S3 settings
				'metaColumns'	=> array(				// Mapping of meta data to database fields
					'ext' => 'ext',
					'type' => 'type',
					'size' => 'size',
					'group' => '',
					'width' => 'width',
					'height' => 'height',
					'filesize' => ''
				)
			)
		),
		'Uploader.FileValidation' => array(
			'fileName' => array(
				'extension' => array(
					'value' => array('gif', 'jpg', 'png', 'jpeg'),
					'error' => 'Mimetype incorrect',
				),
				'required' => array(
					'value' => true,
					'error' => 'File required'
				)
			)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'foreign_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Imagetype' => array(
				'className' => 'Imagetype',
				'foreignKey' => 'imagetype_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
		)
	);
	function beforeValidate() {
		return true;
		return false;
	}
	
	function beforeSave() {
		return true;
		return false;
	}
	
	
}
