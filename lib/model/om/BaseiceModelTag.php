<?php


/**
 * Base class that represents a row from the 'tag' table.
 *
 * 
 *
 * @package    propel.generator.plugins.iceTaggablePlugin.lib.model.om
 */
abstract class BaseiceModelTag extends BaseObject  implements Persistent
{

  /**
   * Peer class name
   */
  const PEER = 'iceModelTagPeer';

  /**
   * The Peer class.
   * Instance provides a convenient way of calling static methods on a class
   * that calling code may not be able to identify.
   * @var        iceModelTagPeer
   */
  protected static $peer;

  /**
   * The value for the id field.
   * @var        int
   */
  protected $id;

  /**
   * The value for the name field.
   * @var        string
   */
  protected $name;

  /**
   * The value for the slug field.
   * @var        string
   */
  protected $slug;

  /**
   * The value for the is_triple field.
   * Note: this column has a database default value of: false
   * @var        boolean
   */
  protected $is_triple;

  /**
   * The value for the triple_namespace field.
   * @var        string
   */
  protected $triple_namespace;

  /**
   * The value for the triple_key field.
   * @var        string
   */
  protected $triple_key;

  /**
   * The value for the triple_value field.
   * @var        string
   */
  protected $triple_value;

  /**
   * @var        array iceModelTagging[] Collection to store aggregation of iceModelTagging objects.
   */
  protected $colliceModelTaggings;

  /**
   * Flag to prevent endless save loop, if this object is referenced
   * by another object which falls in this transaction.
   * @var        boolean
   */
  protected $alreadyInSave = false;

  /**
   * Flag to prevent endless validation loop, if this object is referenced
   * by another object which falls in this transaction.
   * @var        boolean
   */
  protected $alreadyInValidation = false;

  /**
   * Applies default values to this object.
   * This method should be called from the object's constructor (or
   * equivalent initialization method).
   * @see        __construct()
   */
  public function applyDefaultValues()
  {
    $this->is_triple = false;
  }

  /**
   * Initializes internal state of BaseiceModelTag object.
   * @see        applyDefaults()
   */
  public function __construct()
  {
    parent::__construct();
    $this->applyDefaultValues();
  }

  /**
   * Get the [id] column value.
   * 
   * @return     int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Get the [name] column value.
   * 
   * @return     string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Get the [slug] column value.
   * 
   * @return     string
   */
  public function getSlug()
  {
    return $this->slug;
  }

  /**
   * Get the [is_triple] column value.
   * 
   * @return     boolean
   */
  public function getIsTriple()
  {
    return $this->is_triple;
  }

  /**
   * Get the [triple_namespace] column value.
   * 
   * @return     string
   */
  public function getTripleNamespace()
  {
    return $this->triple_namespace;
  }

  /**
   * Get the [triple_key] column value.
   * 
   * @return     string
   */
  public function getTripleKey()
  {
    return $this->triple_key;
  }

  /**
   * Get the [triple_value] column value.
   * 
   * @return     string
   */
  public function getTripleValue()
  {
    return $this->triple_value;
  }

  /**
   * Set the value of [id] column.
   * 
   * @param      int $v new value
   * @return     iceModelTag The current object (for fluent API support)
   */
  public function setId($v)
  {
    if ($v !== null)
    {
      $v = (int) $v;
    }

    if ($this->id !== $v)
    {
      $this->id = $v;
      $this->modifiedColumns[] = iceModelTagPeer::ID;
    }

    return $this;
  }

  /**
   * Set the value of [name] column.
   * 
   * @param      string $v new value
   * @return     iceModelTag The current object (for fluent API support)
   */
  public function setName($v)
  {
    if ($v !== null)
    {
      $v = (string) $v;
    }

    if ($this->name !== $v)
    {
      $this->name = $v;
      $this->modifiedColumns[] = iceModelTagPeer::NAME;
    }

    return $this;
  }

  /**
   * Set the value of [slug] column.
   * 
   * @param      string $v new value
   * @return     iceModelTag The current object (for fluent API support)
   */
  public function setSlug($v)
  {
    if ($v !== null)
    {
      $v = (string) $v;
    }

    if ($this->slug !== $v)
    {
      $this->slug = $v;
      $this->modifiedColumns[] = iceModelTagPeer::SLUG;
    }

    return $this;
  }

  /**
   * Sets the value of the [is_triple] column.
   * Non-boolean arguments are converted using the following rules:
   *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
   *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
   * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
   * 
   * @param      boolean|integer|string $v The new value
   * @return     iceModelTag The current object (for fluent API support)
   */
  public function setIsTriple($v)
  {
    if ($v !== null)
    {
      if (is_string($v))
      {
        $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
      }
      else
      {
        $v = (boolean) $v;
      }
    }

    if ($this->is_triple !== $v)
    {
      $this->is_triple = $v;
      $this->modifiedColumns[] = iceModelTagPeer::IS_TRIPLE;
    }

    return $this;
  }

  /**
   * Set the value of [triple_namespace] column.
   * 
   * @param      string $v new value
   * @return     iceModelTag The current object (for fluent API support)
   */
  public function setTripleNamespace($v)
  {
    if ($v !== null)
    {
      $v = (string) $v;
    }

    if ($this->triple_namespace !== $v)
    {
      $this->triple_namespace = $v;
      $this->modifiedColumns[] = iceModelTagPeer::TRIPLE_NAMESPACE;
    }

    return $this;
  }

  /**
   * Set the value of [triple_key] column.
   * 
   * @param      string $v new value
   * @return     iceModelTag The current object (for fluent API support)
   */
  public function setTripleKey($v)
  {
    if ($v !== null)
    {
      $v = (string) $v;
    }

    if ($this->triple_key !== $v)
    {
      $this->triple_key = $v;
      $this->modifiedColumns[] = iceModelTagPeer::TRIPLE_KEY;
    }

    return $this;
  }

  /**
   * Set the value of [triple_value] column.
   * 
   * @param      string $v new value
   * @return     iceModelTag The current object (for fluent API support)
   */
  public function setTripleValue($v)
  {
    if ($v !== null)
    {
      $v = (string) $v;
    }

    if ($this->triple_value !== $v)
    {
      $this->triple_value = $v;
      $this->modifiedColumns[] = iceModelTagPeer::TRIPLE_VALUE;
    }

    return $this;
  }

  /**
   * Indicates whether the columns in this object are only set to default values.
   *
   * This method can be used in conjunction with isModified() to indicate whether an object is both
   * modified _and_ has some values set which are non-default.
   *
   * @return     boolean Whether the columns in this object are only been set with default values.
   */
  public function hasOnlyDefaultValues()
  {
      if ($this->is_triple !== false)
      {
        return false;
      }

    // otherwise, everything was equal, so return TRUE
    return true;
  }

  /**
   * Hydrates (populates) the object variables with values from the database resultset.
   *
   * An offset (0-based "start column") is specified so that objects can be hydrated
   * with a subset of the columns in the resultset rows.  This is needed, for example,
   * for results of JOIN queries where the resultset row includes columns from two or
   * more tables.
   *
   * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
   * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
   * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
   * @return     int next starting column
   * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
   */
  public function hydrate($row, $startcol = 0, $rehydrate = false)
  {
    try
    {

      $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
      $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
      $this->slug = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
      $this->is_triple = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
      $this->triple_namespace = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
      $this->triple_key = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
      $this->triple_value = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
      $this->resetModified();

      $this->setNew(false);

      if ($rehydrate)
      {
        $this->ensureConsistency();
      }

      return $startcol + 7; // 7 = iceModelTagPeer::NUM_HYDRATE_COLUMNS.

    }
    catch (Exception $e)
    {
      throw new PropelException("Error populating iceModelTag object", $e);
    }
  }

  /**
   * Checks and repairs the internal consistency of the object.
   *
   * This method is executed after an already-instantiated object is re-hydrated
   * from the database.  It exists to check any foreign keys to make sure that
   * the objects related to the current object are correct based on foreign key.
   *
   * You can override this method in the stub class, but you should always invoke
   * the base method from the overridden method (i.e. parent::ensureConsistency()),
   * in case your model changes.
   *
   * @throws     PropelException
   */
  public function ensureConsistency()
  {

  }

  /**
   * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
   *
   * This will only work if the object has been saved and has a valid primary key set.
   *
   * @param      boolean $deep (optional) Whether to also de-associated any related objects.
   * @param      PropelPDO $con (optional) The PropelPDO connection to use.
   * @return     void
   * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
   */
  public function reload($deep = false, PropelPDO $con = null)
  {
    if ($this->isDeleted())
    {
      throw new PropelException("Cannot reload a deleted object.");
    }

    if ($this->isNew())
    {
      throw new PropelException("Cannot reload an unsaved object.");
    }

    if ($con === null)
    {
      $con = Propel::getConnection(iceModelTagPeer::DATABASE_NAME, Propel::CONNECTION_READ);
    }

    // We don't need to alter the object instance pool; we're just modifying this instance
    // already in the pool.

    $stmt = iceModelTagPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
    $row = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if (!$row)
    {
      throw new PropelException('Cannot find matching row in the database to reload object values.');
    }
    $this->hydrate($row, 0, true); // rehydrate

    if ($deep) {  // also de-associate any related objects?

      $this->colliceModelTaggings = null;

    }
  }

  /**
   * Removes this object from datastore and sets delete attribute.
   *
   * @param      PropelPDO $con
   * @return     void
   * @throws     PropelException
   * @see        BaseObject::setDeleted()
   * @see        BaseObject::isDeleted()
   */
  public function delete(PropelPDO $con = null)
  {
    if ($this->isDeleted())
    {
      throw new PropelException("This object has already been deleted.");
    }

    if ($con === null)
    {
      $con = Propel::getConnection(iceModelTagPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    }

    $con->beginTransaction();
    try
    {
      $deleteQuery = iceModelTagQuery::create()
        ->filterByPrimaryKey($this->getPrimaryKey());
      $ret = $this->preDelete($con);
      // symfony_behaviors behavior
      foreach (sfMixer::getCallables('BaseiceModelTag:delete:pre') as $callable)
      {
        if (call_user_func($callable, $this, $con))
        {
          $con->commit();
          return;
        }
      }

      if ($ret)
      {
        $deleteQuery->delete($con);
        $this->postDelete($con);
        // symfony_behaviors behavior
        foreach (sfMixer::getCallables('BaseiceModelTag:delete:post') as $callable)
        {
          call_user_func($callable, $this, $con);
        }

        $con->commit();
        $this->setDeleted(true);
      }
      else
      {
        $con->commit();
      }
    }
    catch (PropelException $e)
    {
      $con->rollBack();
      throw $e;
    }
  }

  /**
   * Persists this object to the database.
   *
   * If the object is new, it inserts it; otherwise an update is performed.
   * All modified related objects will also be persisted in the doSave()
   * method.  This method wraps all precipitate database operations in a
   * single transaction.
   *
   * @param      PropelPDO $con
   * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
   * @throws     PropelException
   * @see        doSave()
   */
  public function save(PropelPDO $con = null)
  {
    if ($this->isDeleted())
    {
      throw new PropelException("You cannot save an object that has been deleted.");
    }

    if ($con === null)
    {
      $con = Propel::getConnection(iceModelTagPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    }

    $con->beginTransaction();
    $isInsert = $this->isNew();
    try
    {
      $ret = $this->preSave($con);
      // symfony_behaviors behavior
      foreach (sfMixer::getCallables('BaseiceModelTag:save:pre') as $callable)
      {
        if (is_integer($affectedRows = call_user_func($callable, $this, $con)))
        {
          $con->commit();
          return $affectedRows;
        }
      }

      if ($isInsert)
      {
        $ret = $ret && $this->preInsert($con);
      }
      else
      {
        $ret = $ret && $this->preUpdate($con);
      }
      if ($ret)
      {
        $affectedRows = $this->doSave($con);
        if ($isInsert)
        {
          $this->postInsert($con);
        }
        else
        {
          $this->postUpdate($con);
        }
        $this->postSave($con);
        // symfony_behaviors behavior
        foreach (sfMixer::getCallables('BaseiceModelTag:save:post') as $callable)
        {
          call_user_func($callable, $this, $con, $affectedRows);
        }

        iceModelTagPeer::addInstanceToPool($this);
      }
      else
      {
        $affectedRows = 0;
      }
      $con->commit();
      return $affectedRows;
    }
    catch (PropelException $e)
    {
      $con->rollBack();
      throw $e;
    }
  }

  /**
   * Performs the work of inserting or updating the row in the database.
   *
   * If the object is new, it inserts it; otherwise an update is performed.
   * All related objects are also updated in this method.
   *
   * @param      PropelPDO $con
   * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
   * @throws     PropelException
   * @see        save()
   */
  protected function doSave(PropelPDO $con)
  {
    $affectedRows = 0; // initialize var to track total num of affected rows
    if (!$this->alreadyInSave)
    {
      $this->alreadyInSave = true;

      if ($this->isNew() )
      {
        $this->modifiedColumns[] = iceModelTagPeer::ID;
      }

      // If this object has been modified, then save it to the database.
      if ($this->isModified())
      {
        if ($this->isNew())
        {
          $criteria = $this->buildCriteria();
          if ($criteria->keyContainsValue(iceModelTagPeer::ID) )
          {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.iceModelTagPeer::ID.')');
          }

          $pk = BasePeer::doInsert($criteria, $con);
          $affectedRows = 1;
          $this->setId($pk);  //[IMV] update autoincrement primary key
          $this->setNew(false);
        }
        else
        {
          $affectedRows = iceModelTagPeer::doUpdate($this, $con);
        }

        $this->resetModified(); // [HL] After being saved an object is no longer 'modified'
      }

      if ($this->colliceModelTaggings !== null)
      {
        foreach ($this->colliceModelTaggings as $referrerFK)
        {
          if (!$referrerFK->isDeleted())
          {
            $affectedRows += $referrerFK->save($con);
          }
        }
      }

      $this->alreadyInSave = false;

    }
    return $affectedRows;
  }

  /**
   * Array of ValidationFailed objects.
   * @var        array ValidationFailed[]
   */
  protected $validationFailures = array();

  /**
   * Gets any ValidationFailed objects that resulted from last call to validate().
   *
   *
   * @return     array ValidationFailed[]
   * @see        validate()
   */
  public function getValidationFailures()
  {
    return $this->validationFailures;
  }

  /**
   * Validates the objects modified field values and all objects related to this table.
   *
   * If $columns is either a column name or an array of column names
   * only those columns are validated.
   *
   * @param      mixed $columns Column name or an array of column names.
   * @return     boolean Whether all columns pass validation.
   * @see        doValidate()
   * @see        getValidationFailures()
   */
  public function validate($columns = null)
  {
    $res = $this->doValidate($columns);
    if ($res === true)
    {
      $this->validationFailures = array();
      return true;
    }
    else
    {
      $this->validationFailures = $res;
      return false;
    }
  }

  /**
   * This function performs the validation work for complex object models.
   *
   * In addition to checking the current object, all related objects will
   * also be validated.  If all pass then <code>true</code> is returned; otherwise
   * an aggreagated array of ValidationFailed objects will be returned.
   *
   * @param      array $columns Array of column names to validate.
   * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
   */
  protected function doValidate($columns = null)
  {
    if (!$this->alreadyInValidation)
    {
      $this->alreadyInValidation = true;
      $retval = null;

      $failureMap = array();


      if (($retval = iceModelTagPeer::doValidate($this, $columns)) !== true)
      {
        $failureMap = array_merge($failureMap, $retval);
      }


        if ($this->colliceModelTaggings !== null)
        {
          foreach ($this->colliceModelTaggings as $referrerFK)
          {
            if (!$referrerFK->validate($columns))
            {
              $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
            }
          }
        }


      $this->alreadyInValidation = false;
    }

    return (!empty($failureMap) ? $failureMap : true);
  }

  /**
   * Retrieves a field from the object by name passed in as a string.
   *
   * @param      string $name name
   * @param      string $type The type of fieldname the $name is of:
   *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
   *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
   * @return     mixed Value of field.
   */
  public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
  {
    $pos = iceModelTagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
    $field = $this->getByPosition($pos);
    return $field;
  }

  /**
   * Retrieves a field from the object by Position as specified in the xml schema.
   * Zero-based.
   *
   * @param      int $pos position in xml schema
   * @return     mixed Value of field at $pos
   */
  public function getByPosition($pos)
  {
    switch($pos)
    {
      case 0:
        return $this->getId();
        break;
      case 1:
        return $this->getName();
        break;
      case 2:
        return $this->getSlug();
        break;
      case 3:
        return $this->getIsTriple();
        break;
      case 4:
        return $this->getTripleNamespace();
        break;
      case 5:
        return $this->getTripleKey();
        break;
      case 6:
        return $this->getTripleValue();
        break;
      default:
        return null;
        break;
    }
  }

  /**
   * Exports the object as an array.
   *
   * You can specify the key type of the array by passing one of the class
   * type constants.
   *
   * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
   *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
   *                    Defaults to BasePeer::TYPE_PHPNAME.
   * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
   * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
   * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
   *
   * @return    array an associative array containing the field names (as keys) and field values
   */
  public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
  {
    if (isset($alreadyDumpedObjects['iceModelTag'][$this->getPrimaryKey()]))
    {
      return '*RECURSION*';
    }
    $alreadyDumpedObjects['iceModelTag'][$this->getPrimaryKey()] = true;
    $keys = iceModelTagPeer::getFieldNames($keyType);
    $result = array(
      $keys[0] => $this->getId(),
      $keys[1] => $this->getName(),
      $keys[2] => $this->getSlug(),
      $keys[3] => $this->getIsTriple(),
      $keys[4] => $this->getTripleNamespace(),
      $keys[5] => $this->getTripleKey(),
      $keys[6] => $this->getTripleValue(),
    );
    if ($includeForeignObjects)
    {
      if (null !== $this->colliceModelTaggings)
      {
        $result['iceModelTaggings'] = $this->colliceModelTaggings->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
      }
    }
    return $result;
  }

  /**
   * Sets a field from the object by name passed in as a string.
   *
   * @param      string $name peer name
   * @param      mixed $value field value
   * @param      string $type The type of fieldname the $name is of:
   *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
   *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
   * @return     void
   */
  public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
  {
    $pos = iceModelTagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
    return $this->setByPosition($pos, $value);
  }

  /**
   * Sets a field from the object by Position as specified in the xml schema.
   * Zero-based.
   *
   * @param      int $pos position in xml schema
   * @param      mixed $value field value
   * @return     void
   */
  public function setByPosition($pos, $value)
  {
    switch($pos)
    {
      case 0:
        $this->setId($value);
        break;
      case 1:
        $this->setName($value);
        break;
      case 2:
        $this->setSlug($value);
        break;
      case 3:
        $this->setIsTriple($value);
        break;
      case 4:
        $this->setTripleNamespace($value);
        break;
      case 5:
        $this->setTripleKey($value);
        break;
      case 6:
        $this->setTripleValue($value);
        break;
    }
  }

  /**
   * Populates the object using an array.
   *
   * This is particularly useful when populating an object from one of the
   * request arrays (e.g. $_POST).  This method goes through the column
   * names, checking to see whether a matching key exists in populated
   * array. If so the setByName() method is called for that column.
   *
   * You can specify the key type of the array by additionally passing one
   * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
   * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
   * The default key type is the column's phpname (e.g. 'AuthorId')
   *
   * @param      array  $arr     An array to populate the object from.
   * @param      string $keyType The type of keys the array uses.
   * @return     void
   */
  public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
  {
    $keys = iceModelTagPeer::getFieldNames($keyType);

    if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
    if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
    if (array_key_exists($keys[2], $arr)) $this->setSlug($arr[$keys[2]]);
    if (array_key_exists($keys[3], $arr)) $this->setIsTriple($arr[$keys[3]]);
    if (array_key_exists($keys[4], $arr)) $this->setTripleNamespace($arr[$keys[4]]);
    if (array_key_exists($keys[5], $arr)) $this->setTripleKey($arr[$keys[5]]);
    if (array_key_exists($keys[6], $arr)) $this->setTripleValue($arr[$keys[6]]);
  }

  /**
   * Build a Criteria object containing the values of all modified columns in this object.
   *
   * @return     Criteria The Criteria object containing all modified values.
   */
  public function buildCriteria()
  {
    $criteria = new Criteria(iceModelTagPeer::DATABASE_NAME);

    if ($this->isColumnModified(iceModelTagPeer::ID)) $criteria->add(iceModelTagPeer::ID, $this->id);
    if ($this->isColumnModified(iceModelTagPeer::NAME)) $criteria->add(iceModelTagPeer::NAME, $this->name);
    if ($this->isColumnModified(iceModelTagPeer::SLUG)) $criteria->add(iceModelTagPeer::SLUG, $this->slug);
    if ($this->isColumnModified(iceModelTagPeer::IS_TRIPLE)) $criteria->add(iceModelTagPeer::IS_TRIPLE, $this->is_triple);
    if ($this->isColumnModified(iceModelTagPeer::TRIPLE_NAMESPACE)) $criteria->add(iceModelTagPeer::TRIPLE_NAMESPACE, $this->triple_namespace);
    if ($this->isColumnModified(iceModelTagPeer::TRIPLE_KEY)) $criteria->add(iceModelTagPeer::TRIPLE_KEY, $this->triple_key);
    if ($this->isColumnModified(iceModelTagPeer::TRIPLE_VALUE)) $criteria->add(iceModelTagPeer::TRIPLE_VALUE, $this->triple_value);

    return $criteria;
  }

  /**
   * Builds a Criteria object containing the primary key for this object.
   *
   * Unlike buildCriteria() this method includes the primary key values regardless
   * of whether or not they have been modified.
   *
   * @return     Criteria The Criteria object containing value(s) for primary key(s).
   */
  public function buildPkeyCriteria()
  {
    $criteria = new Criteria(iceModelTagPeer::DATABASE_NAME);
    $criteria->add(iceModelTagPeer::ID, $this->id);

    return $criteria;
  }

  /**
   * Returns the primary key for this object (row).
   * @return     int
   */
  public function getPrimaryKey()
  {
    return $this->getId();
  }

  /**
   * Generic method to set the primary key (id column).
   *
   * @param      int $key Primary key.
   * @return     void
   */
  public function setPrimaryKey($key)
  {
    $this->setId($key);
  }

  /**
   * Returns true if the primary key for this object is null.
   * @return     boolean
   */
  public function isPrimaryKeyNull()
  {
    return null === $this->getId();
  }

  /**
   * Sets contents of passed object to values from current object.
   *
   * If desired, this method can also make copies of all associated (fkey referrers)
   * objects.
   *
   * @param      object $copyObj An object of iceModelTag (or compatible) type.
   * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
   * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
   * @throws     PropelException
   */
  public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
  {
    $copyObj->setName($this->getName());
    $copyObj->setSlug($this->getSlug());
    $copyObj->setIsTriple($this->getIsTriple());
    $copyObj->setTripleNamespace($this->getTripleNamespace());
    $copyObj->setTripleKey($this->getTripleKey());
    $copyObj->setTripleValue($this->getTripleValue());

    if ($deepCopy)
    {
      // important: temporarily setNew(false) because this affects the behavior of
      // the getter/setter methods for fkey referrer objects.
      $copyObj->setNew(false);

      foreach ($this->geticeModelTaggings() as $relObj)
      {
        if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
          $copyObj->addiceModelTagging($relObj->copy($deepCopy));
        }
      }

    }

    if ($makeNew)
    {
      $copyObj->setNew(true);
      $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
    }
  }

  /**
   * Makes a copy of this object that will be inserted as a new row in table when saved.
   * It creates a new object filling in the simple attributes, but skipping any primary
   * keys that are defined for the table.
   *
   * If desired, this method can also make copies of all associated (fkey referrers)
   * objects.
   *
   * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
   * @return     iceModelTag Clone of current object.
   * @throws     PropelException
   */
  public function copy($deepCopy = false)
  {
    // we use get_class(), because this might be a subclass
    $clazz = get_class($this);
    $copyObj = new $clazz();
    $this->copyInto($copyObj, $deepCopy);
    return $copyObj;
  }

  /**
   * Returns a peer instance associated with this om.
   *
   * Since Peer classes are not to have any instance attributes, this method returns the
   * same instance for all member of this class. The method could therefore
   * be static, but this would prevent one from overriding the behavior.
   *
   * @return     iceModelTagPeer
   */
  public function getPeer()
  {
    if (self::$peer === null)
    {
      self::$peer = new iceModelTagPeer();
    }
    return self::$peer;
  }


  /**
   * Initializes a collection based on the name of a relation.
   * Avoids crafting an 'init[$relationName]s' method name
   * that wouldn't work when StandardEnglishPluralizer is used.
   *
   * @param      string $relationName The name of the relation to initialize
   * @return     void
   */
  public function initRelation($relationName)
  {
    if ('iceModelTagging' == $relationName)
    {
      return $this->initiceModelTaggings();
    }
  }

  /**
   * Clears out the colliceModelTaggings collection
   *
   * This does not modify the database; however, it will remove any associated objects, causing
   * them to be refetched by subsequent calls to accessor method.
   *
   * @return     void
   * @see        addiceModelTaggings()
   */
  public function cleariceModelTaggings()
  {
    $this->colliceModelTaggings = null; // important to set this to NULL since that means it is uninitialized
  }

  /**
   * Initializes the colliceModelTaggings collection.
   *
   * By default this just sets the colliceModelTaggings collection to an empty array (like clearcolliceModelTaggings());
   * however, you may wish to override this method in your stub class to provide setting appropriate
   * to your application -- for example, setting the initial array to the values stored in database.
   *
   * @param      boolean $overrideExisting If set to true, the method call initializes
   *                                        the collection even if it is not empty
   *
   * @return     void
   */
  public function initiceModelTaggings($overrideExisting = true)
  {
    if (null !== $this->colliceModelTaggings && !$overrideExisting)
    {
      return;
    }
    $this->colliceModelTaggings = new PropelObjectCollection();
    $this->colliceModelTaggings->setModel('iceModelTagging');
  }

  /**
   * Gets an array of iceModelTagging objects which contain a foreign key that references this object.
   *
   * If the $criteria is not null, it is used to always fetch the results from the database.
   * Otherwise the results are fetched from the database the first time, then cached.
   * Next time the same method is called without $criteria, the cached collection is returned.
   * If this iceModelTag is new, it will return
   * an empty collection or the current collection; the criteria is ignored on a new object.
   *
   * @param      Criteria $criteria optional Criteria object to narrow the query
   * @param      PropelPDO $con optional connection object
   * @return     PropelCollection|array iceModelTagging[] List of iceModelTagging objects
   * @throws     PropelException
   */
  public function geticeModelTaggings($criteria = null, PropelPDO $con = null)
  {
    if(null === $this->colliceModelTaggings || null !== $criteria)
    {
      if ($this->isNew() && null === $this->colliceModelTaggings)
      {
        // return empty collection
        $this->initiceModelTaggings();
      }
      else
      {
        $colliceModelTaggings = iceModelTaggingQuery::create(null, $criteria)
          ->filterByiceModelTag($this)
          ->find($con);
        if (null !== $criteria)
        {
          return $colliceModelTaggings;
        }
        $this->colliceModelTaggings = $colliceModelTaggings;
      }
    }
    return $this->colliceModelTaggings;
  }

  /**
   * Returns the number of related iceModelTagging objects.
   *
   * @param      Criteria $criteria
   * @param      boolean $distinct
   * @param      PropelPDO $con
   * @return     int Count of related iceModelTagging objects.
   * @throws     PropelException
   */
  public function counticeModelTaggings(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
  {
    if(null === $this->colliceModelTaggings || null !== $criteria)
    {
      if ($this->isNew() && null === $this->colliceModelTaggings)
      {
        return 0;
      }
      else
      {
        $query = iceModelTaggingQuery::create(null, $criteria);
        if($distinct)
        {
          $query->distinct();
        }
        return $query
          ->filterByiceModelTag($this)
          ->count($con);
      }
    }
    else
    {
      return count($this->colliceModelTaggings);
    }
  }

  /**
   * Method called to associate a iceModelTagging object to this object
   * through the iceModelTagging foreign key attribute.
   *
   * @param      iceModelTagging $l iceModelTagging
   * @return     iceModelTag The current object (for fluent API support)
   */
  public function addiceModelTagging(iceModelTagging $l)
  {
    if ($this->colliceModelTaggings === null)
    {
      $this->initiceModelTaggings();
    }
    if (!$this->colliceModelTaggings->contains($l)) { // only add it if the **same** object is not already associated
      $this->colliceModelTaggings[]= $l;
      $l->seticeModelTag($this);
    }

    return $this;
  }

  /**
   * Clears the current object and sets all attributes to their default values
   */
  public function clear()
  {
    $this->id = null;
    $this->name = null;
    $this->slug = null;
    $this->is_triple = null;
    $this->triple_namespace = null;
    $this->triple_key = null;
    $this->triple_value = null;
    $this->alreadyInSave = false;
    $this->alreadyInValidation = false;
    $this->clearAllReferences();
    $this->applyDefaultValues();
    $this->resetModified();
    $this->setNew(true);
    $this->setDeleted(false);
  }

  /**
   * Resets all references to other model objects or collections of model objects.
   *
   * This method is a user-space workaround for PHP's inability to garbage collect
   * objects with circular references (even in PHP 5.3). This is currently necessary
   * when using Propel in certain daemon or large-volumne/high-memory operations.
   *
   * @param      boolean $deep Whether to also clear the references on all referrer objects.
   */
  public function clearAllReferences($deep = false)
  {
    if ($deep)
    {
      if ($this->colliceModelTaggings)
      {
        foreach ($this->colliceModelTaggings as $o)
        {
          $o->clearAllReferences($deep);
        }
      }
    }

    if ($this->colliceModelTaggings instanceof PropelCollection)
    {
      $this->colliceModelTaggings->clearIterator();
    }
    $this->colliceModelTaggings = null;
  }

  /**
   * Return the string representation of this object
   *
   * @return string The value of the 'name' column
   */
  public function __toString()
  {
    return (string) $this->getName();
  }

  /**
   * Catches calls to virtual methods
   */
  public function __call($name, $params)
  {
    
    // symfony_behaviors behavior
    if ($callable = sfMixer::getCallable('BaseiceModelTag:' . $name))
    {
      array_unshift($params, $this);
      return call_user_func_array($callable, $params);
    }

    return parent::__call($name, $params);
  }

}
