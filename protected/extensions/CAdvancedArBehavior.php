<?php
/**
 * CAdvancedArBehavior class file.
 *
 * @author Herbert Maschke <thyseus@gmail.com>
 * @link http://www.yiiframework.com/
 * @version 0.3
 */

/* The CAdvancedArBehavior extension adds up some functionality to the default
 * possibilites of yii´s ActiveRecord implementation.
 *
 * To use this extension, just copy this file to your extensions/ directory,
 * add 'import' => 'application.extensions.CAdvancedArBehavior', [...] to your 
 * config/main.php and add this behavior to each model you would like to
 * inherit the new possibilities:
 *
 * public function behaviors(){
 *         return array( 'CAdvancedArBehavior' => array(
 *        	 'class' => 'application.extensions.CAdvancedArBehavior')); 
 *         }                                  
 *
 *
 * Automatically sync your Database Schema when setting new fields by
 * activating $syncdb
 *
 * Better support of MANY_TO_MANY relations:
 *
 * When we have defined a MANY_MANY relation in our relations() function, we
 * are now able to add up instances of the foreign Model on the fly while
 * saving our Model to the Database. Let´s assume the following Relation:
 *
 * Post has:
 *  'categories'=>array(self::MANY_MANY, 'Category',
 *                  'tbl_post_category(post_id, category_id)')
 *
 * Category has:
 * 'posts'=>array(self::MANY_MANY, 'Post',
 *                  'tbl_post_category(category_id, post_id)')
 *
 * Now we can use the attribute 'categories' of our Post model to add up new
 * rows to our MANY_MANY connection Table:
 *
 * $post = new Post();
 * $post->categories = Category::model()->findAll();
 * $post->save();
 *
 * This will save our new Post in the table Post, and in addition to this it
 * updates our N:M-Table with every Category available in the Database.
 * 
 * We can further limit the Objects given to the attribute, and can also go 
 * the other Way around:
 *
 * $category = new Category();
 * $category->posts = array(5, 6, 7, 10);
 * $caregory->save(); 
 *
 * We can pass Object instances like in the first example, or a list of
 * integers that representates the Primary key of the Foreign Table, so that
 * the Posts with the id 5, 6, 7 and 10 get´s added up to our new Category.
 *
 * 5 Queries will be performed here, one for the Category-Model and four for
 * the N:M-Table tbl_post_category. Note that this behavior could be tuned
 * further in the future, so only one query get´s executed for the MANY_MANY
 * Table.
 *
 * We can also pass a _single_ object or an single integer:
 *
 * $category = new Category();
 * $category->posts = Post::model()->findByPk(12);
 * $category->posts = 12;
 * $category->save();
 * 
 * Assign -1 to a attribute to let it be untouched by the behavior.
 */


class CAdvancedArbehavior extends CActiveRecordBehavior
{
	// Set this to false to disable tracing of changes
	public $trace = true;

	// If you want to ignore some relations, set them here.
	public $ignoreRelations = array();

	// After the save process of the model this behavior is attached to 
	// is finished, we begin saving our MANY_MANY related data 
	public function afterSave($event) 
	{
		if(!is_array($this->ignoreRelations))
			throw new CException('ignoreRelations of CAdvancedArBehavior needs to be an array');
		$this->writeManyManyTables();
		parent::afterSave($event);
		return true;
	}
	
	public function beforeDelete($event)
	{
		if($this->trace)
			Yii::trace('deleting MANY_MANY data for '.get_class($this->owner), 'system.db.ar.CActiveRecord');
		foreach($this->getRelations() as $relation) 
		{
			$this->cleanRelation($relation);
		}
	}
	
	protected function writeManyManyTables() 
	{
		if($this->trace)
			Yii::trace('writing MANY_MANY data for '.get_class($this->owner), 'system.db.ar.CActiveRecord');
		foreach($this->getRelations() as $relation) 
		{
			$this->cleanRelation($relation);
			$this->writeRelation($relation);
		}
	}

	/* A relation will have the following format:
	 $relation['m2mTable'] = the tablename of the foreign object
	 $relation['m2mThisField'] = the column in the many2many table that represents the primary Key of the object that this behavior is attached to
	 $relation['m2mForeignField'] = the column in the many2many table that represents the foreign object. 

  Written in Yii relation syntax, it would be like this
		'relationname' => array('foreignobject', 'column', 'm2mTable(m2mThisField, m2mForeignField) */
	protected function getRelations()
	{
		$relations = array();

		foreach ($this->owner->getMetaData()->relations as $key => $relation)
		{
			if (get_class($relation) == CActiveRecord::MANY_MANY &&
					!in_array($key, $this->ignoreRelations) &&
					$this->owner->hasRelated($key) &&
					$this->owner->$key != -1)
			{
				$info = array();
				$info['key'] = $key;
				$info['foreignTable'] = $relation->className;

					if (preg_match('/^(.+)\((.+)\s*,\s*(.+)\)$/s', $relation->foreignKey, $pocks))
					{
						$info['m2mTable'] = $pocks[1];
						$info['m2mThisField'] = $pocks[2];
						$info['m2mForeignField'] = $pocks[3];
					}
					else
					{
						$info['m2mTable'] = $relation->foreignKey;
						$info['m2mThisField'] = $this->owner->tableSchema->PrimaryKey;
						$info['m2mForeignField'] = CActiveRecord::model($relation->className)->tableSchema->primaryKey;
					}
				$relations[$key] = $info;
			}
		}
		return $relations;
	}

	/** writeRelation's job is to check if the user has given an array or an 
	 * single Object, and executes the needed query */
	protected function writeRelation($relation) 
	{
		$key = $relation['key'];

		// Only an object or primary key id is given
		if(!is_array($this->owner->$key) && $this->owner->$key != array()) 		
			$this->owner->$key = array($this->owner->$key);
		
		else if (is_array($this->owner->$key)&& $this->owner->$key != array()) {

			// array of already added
			$addedIds = array();
			// An array of objects is given
			foreach((array)$this->owner->$key as $foreignobject)
			{
				if(!is_numeric($foreignobject) && is_object($foreignobject)) {
					// $foreignobject = $foreignobject->{$foreignobject->$relation['m2mForeignField']};
					// bug with Model.model_id
					$foreignobject = $foreignobject->primaryKey;
				}
				// only unique values for M2M
				// skip object, if it has been already added
				if(in_array((int)$foreignobject, array_values($addedIds))) continue;
				$this->execute($this->makeManyManyInsertCommand($relation, $foreignobject));
				
				// adding to list of added
				$addedIds[] = (int)$foreignobject;
			}

		}

	}

	/* before saving our relation data, we need to clean up exsting relations so
	 * they are synchronized */
	protected function cleanRelation($relation)
	{
		try
		{
			$this->execute($this->makeManyManyDeleteCommand($relation));
		}
		catch (CDbException $ex) {
			// ignore any errors on cleaning the relation - just log them
			Yii::trace("caught exception while cleaning relation '{$relation['foreignTable']}.{$relation['key']}': ".$ex->getMessage(), 'system.db.ar.CActiveRecord');
		}
	}

	// A wrapper function for execution of SQL queries
	public function execute($query) {
		return Yii::app()->db->createCommand($query)->execute();
	}

	public function makeManyManyInsertCommand($relation, $value) {
		return sprintf("insert into %s (%s, %s) values ('%s', '%s')",
			$relation['m2mTable'],
			$relation['m2mThisField'],
			$relation['m2mForeignField'],
			$this->owner->{$this->owner->tableSchema->primaryKey},
			$value);
	}

	public function makeManyManyDeleteCommand($relation) {
		return sprintf("delete from %s where %s = '%s'",
			$relation['m2mTable'],
			$relation['m2mThisField'],
			$this->owner->{$this->owner->tableSchema->primaryKey}
		);
	}
}
