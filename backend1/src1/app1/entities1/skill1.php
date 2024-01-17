<?php

namespace App\Entities1;

use Illuminate\Contracts\Support\Arrayable;

const TOOL_SKILL_TYPE = 0;
const PERSONAL_INTERNAL_SKILL_TYPE = 1;
const PERSONAL_EXTERNAL_SKILL_TYPE = 2;
const LANGUAGE_SKILL_TYPE = 3;
const OTHER_SKILL_TYPE = 4;
const VALID_SKILL_TYPES = [TOOL_SKILL_TYPE, PERSONAL_INTERNAL_SKILL_TYPE, PERSONAL_EXTERNAL_SKILL_TYPE, LANGUAGE_SKILL_TYPE, OTHER_SKILL_TYPE];

class Skill1 implements Arrayable
{
    protected $id;
    protected $name;
    protected $explainer;
    protected $type;
    protected $fixedCase;
    protected $category;
    protected $ownerUser;
    protected $createdTime;
    protected $updatedTime;

    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        if (!in_array($type, VALID_SKILL_TYPES)) {
            throw new \TypeError('Skill type ' . $type . ' is not valid. Valid types are id: ' . implode(', ', VALID_SKILL_TYPES));
        }

        $this->type = $type;

        return $this;
    }

    // ... (rest of your existing methods)
}
