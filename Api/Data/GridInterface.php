<?php

namespace Mageget\Slider\Api\Data;

interface GridInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    public const ID = 'banner_id';
    public const NAME = 'name';
    public const TITLE = 'title';
    public const CONTENT = 'content';
    public const IMAGE = 'image';
    public const STATUS = 'status';
    public const CREATED_AT = 'created_at';
      
    /**
     * Get Entity Id
     *
     * @return void
     */
    public function getEntityId();
    
    /**
     * Set EntityId
     *
     * @param  mixed $Id
     * @return void
     */
    public function setEntityId($Id);
    
    /**
     * Get Name
     *
     * @return void
     */
    public function getName();
    
    /**
     * Set Name
     *
     * @param  mixed $name
     * @return void
     */
    public function setName($name);

    /**
     * Get title.
     *
     * @return varchar
     */
    public function geteTitle();
    
    /**
     * Set Title
     *
     * @param  mixed $title
     * @return void
     */
    public function setTitle($title);
   
    /**
     * Get Content.
     *
     * @return varchar
     */
    public function geteContent();
    
    /**
     * Set Content
     *
     * @param  mixed $phonenumber
     * @return void
     */
    public function setContent($phonenumber);

   /**
    * Get geteDob.
    *
    * @return varchar
    */
    public function geteImage();
    
    /**
     * Set Image
     *
     * @param  mixed $image
     * @return void
     */
    public function setImage($image);
    
    /**
     * Get CreatedAt.
     *
     * @return varchar
     */
    public function getCreatedAt();

    /**
     * Set CreatedAt
     *
     * @param  mixed $createdAt
     * @return void
     */
    public function setCreatedAt($createdAt);
}
