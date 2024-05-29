<?php

/**
 * BaseJobeetJob
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property int             $category_id                           Type: integer
 * @property string          $type                                  Type: string(255)
 * @property string          $company                               Type: string(255)
 * @property string          $logo                                  Type: string(255)
 * @property string          $url                                   Type: string(255)
 * @property string          $position                              Type: string(255)
 * @property string          $location                              Type: string(255)
 * @property string          $description                           Type: string(4000)
 * @property string          $how_to_apply                          Type: string(4000)
 * @property string          $token                                 Type: string(255), unique
 * @property bool            $is_public                             Type: boolean, default "1"
 * @property bool            $is_activated                          Type: boolean
 * @property string          $email                                 Type: string(255)
 * @property string          $expires_at                            Type: timestamp, Timestamp in ISO-8601 format (YYYY-MM-DD HH:MI:SS)
 * @property JobeetCategory  $JobeetCategory                        
 *  
 * @method int               getCategoryId()                        Type: integer
 * @method string            getType()                              Type: string(255)
 * @method string            getCompany()                           Type: string(255)
 * @method string            getLogo()                              Type: string(255)
 * @method string            getUrl()                               Type: string(255)
 * @method string            getPosition()                          Type: string(255)
 * @method string            getLocation()                          Type: string(255)
 * @method string            getDescription()                       Type: string(4000)
 * @method string            getHowToApply()                        Type: string(4000)
 * @method string            getToken()                             Type: string(255), unique
 * @method bool              getIsPublic()                          Type: boolean, default "1"
 * @method bool              getIsActivated()                       Type: boolean
 * @method string            getEmail()                             Type: string(255)
 * @method string            getExpiresAt()                         Type: timestamp, Timestamp in ISO-8601 format (YYYY-MM-DD HH:MI:SS)
 * @method JobeetCategory    getJobeetCategory()                    
 *  
 * @method JobeetJob         setCategoryId(int $val)                Type: integer
 * @method JobeetJob         setType(string $val)                   Type: string(255)
 * @method JobeetJob         setCompany(string $val)                Type: string(255)
 * @method JobeetJob         setLogo(string $val)                   Type: string(255)
 * @method JobeetJob         setUrl(string $val)                    Type: string(255)
 * @method JobeetJob         setPosition(string $val)               Type: string(255)
 * @method JobeetJob         setLocation(string $val)               Type: string(255)
 * @method JobeetJob         setDescription(string $val)            Type: string(4000)
 * @method JobeetJob         setHowToApply(string $val)             Type: string(4000)
 * @method JobeetJob         setToken(string $val)                  Type: string(255), unique
 * @method JobeetJob         setIsPublic(bool $val)                 Type: boolean, default "1"
 * @method JobeetJob         setIsActivated(bool $val)              Type: boolean
 * @method JobeetJob         setEmail(string $val)                  Type: string(255)
 * @method JobeetJob         setExpiresAt(string $val)              Type: timestamp, Timestamp in ISO-8601 format (YYYY-MM-DD HH:MI:SS)
 * @method JobeetJob         setJobeetCategory(JobeetCategory $val) 
 *  
 * @package    jobeet
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseJobeetJob extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('jobeet_job');
        $this->hasColumn('category_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('type', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('company', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('logo', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('url', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('position', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('location', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('description', 'string', 4000, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 4000,
             ));
        $this->hasColumn('how_to_apply', 'string', 4000, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 4000,
             ));
        $this->hasColumn('token', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 255,
             ));
        $this->hasColumn('is_public', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => 1,
             ));
        $this->hasColumn('is_activated', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('email', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('expires_at', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('JobeetCategory', array(
             'local' => 'category_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}