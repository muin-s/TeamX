<?php

namespace App\Entities1;

use Illuminate\Contracts\Support\Arrayable;

class Task1 implements Arrayable
{
    protected $id;
    protected $description;
    protected $weightPct;
    protected $performedInJobExperience;

    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * Getters and setters for description, weightPct, performedInJobExperience
     */

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getWeightPct()
    {
        return $this->weightPct;
    }

    public function setWeightPct($weightPct)
    {
        $this->weightPct = $weightPct;
        return $this;
    }

    public function getPerformedInJobExperience()
    {
        return $this->performedInJobExperience;
    }

    public function setPerformedInJobExperience($performedInJobExperience)
    {
        $this->performedInJobExperience = $performedInJobExperience;
        return $this;
    }
}
