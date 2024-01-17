<?php

namespace App\Entities;

use Illuminate\Contracts\Support\Arrayable;

class Testimonial implements Arrayable
{
    protected $id;
    protected $summaryHtml;
    protected $byName;
    protected $contactPhoneNo;
    protected $contactEmail;
    protected $onLinkedInProfile;
    protected $onPaper;
    
    /** @var JobExperience */
    protected $aboutJobExperience;

    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * Get the value of aboutJobExperience
     *
     * @return JobExperience|null
     */
    public function getAboutJobExperience()
    {
        return $this->aboutJobExperience;
    }

    /**
     * Set the value of aboutJobExperience
     *
     * @param JobExperience|null $aboutJobExperience
     * @return self
     */
    public function setAboutJobExperience(?JobExperience $aboutJobExperience)
    {
        $this->aboutJobExperience = $aboutJobExperience;
        return $this;
    }
}
