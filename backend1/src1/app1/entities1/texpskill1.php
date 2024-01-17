<?php

namespace App\Entities;

use Illuminate\Contracts\Support\Arrayable;

class TaskExpSkill implements Arrayable
{
    protected $usageWeightPct;
    protected $usedSkill;
    protected $usedWithTask;

    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * Get the value of usageWeightPct
     */ 
    public function getUsageWeightPct()
    {
        return $this->usageWeightPct;
    }

    /**
     * Set the value of usageWeightPct
     *
     * @param  float  $usageWeightPct
     * @return  self
     */ 
    public function setUsageWeightPct($usageWeightPct)
    {
        $this->usageWeightPct = $usageWeightPct;
        return $this;
    }

    /**
     * Get the value of usedSkill
     */ 
    public function getUsedSkill()
    {
        return $this->usedSkill;
    }

    /**
     * Set the value of usedSkill
     *
     * @param  string  $usedSkill
     * @return  self
     */ 
    public function setUsedSkill($usedSkill)
    {
        $this->usedSkill = $usedSkill;
        return $this;
    }

    /**
     * Get the value of usedWithTask
     */ 
    public function getUsedWithTask()
    {
        return $this->usedWithTask;
    }

    /**
     * Set the value of usedWithTask
     *
     * @param  string  $usedWithTask
     * @return  self
     */ 
    public function setUsedWithTask($usedWithTask)
    {
        $this->usedWithTask = $usedWithTask;
        return $this;
    }
}
