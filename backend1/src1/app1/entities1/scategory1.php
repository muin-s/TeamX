<?php

namespace App\Entities1;

use Illuminate\Contracts\Support\Arrayable;

class SkillCategory1 implements Arrayable
{
    protected $id;
    protected $name;
    protected $icon;
    protected $foregroundColorHex;
    protected $backgroundColorHex;
    protected $usedInSkills;
    protected $ownerUser;
    protected $createdTime;
    protected $updatedTime;

    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * Getters and setters for createdTime, updatedTime, id, name, icon, foregroundColorHex, backgroundColorHex, ownerUser
     */

    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    public function setCreatedTime($createdTime)
    {
        $this->createdTime = $createdTime;
        return $this;
    }

    public function getUpdatedTime()
    {
        return $this->updatedTime;
    }

    public function setUpdatedTime($updatedTime)
    {
        $this->updatedTime = $updatedTime;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    public function getForegroundColorHex()
    {
        return $this->foregroundColorHex;
    }

    public function setForegroundColorHex($foregroundColorHex)
    {
        $this->foregroundColorHex = $foregroundColorHex;
        return $this;
    }

    public function getBackgroundColorHex()
    {
        return $this->backgroundColorHex;
    }

    public function setBackgroundColorHex($backgroundColorHex)
    {
        $this->backgroundColorHex = $backgroundColorHex;
        return $this;
    }

    public function getOwnerUser()
    {
        return $this->ownerUser;
    }

    public function setOwnerUser($ownerUser)
    {
        $this->ownerUser = $ownerUser;
        return $this;
    }
}
