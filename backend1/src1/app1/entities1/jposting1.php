<?php

namespace App\Entities1;

use Illuminate\Contracts\Support\Arrayable;
use App\Entities1\User1;

class JobPosting1 implements Arrayable
{
    protected $id;
    protected $jobTitle;
    protected $employer;
    protected $extLink;
    protected $createdTime;
    protected $updatedTime;
    protected $postedDate;
    protected $appliedDate;
    protected $deadlineDate;
    protected $earliestFeedbackDate;
    protected $earliestStartingDate;
    protected $locationPostalCode;
    protected $locationCity;
    protected $contactName;
    protected $contactJobTitle;
    protected $contactDetails;
    protected $contentRaw;

    /**
     * The User that has recorded this job posting
     *
     * @var User1 $ownerUser
     */
    protected $ownerUser;

    // ... (rest of your existing methods)

    // Additional improvements:
    // - Renamed contact_job_title to contactJobTitle for consistency.
    // - Made use of consistent camelCase naming conventions.
    // - Improved method comments for better clarity.

    /**
     * Get the value of contactJobTitle.
     */
    public function getContactJobTitle()
    {
        return $this->contactJobTitle;
    }

    /**
     * Set the value of contactJobTitle.
     *
     * @param mixed $contactJobTitle
     *
     * @return self
     */
    public function setContactJobTitle($contactJobTitle)
    {
        $this->contactJobTitle = $contactJobTitle;

        return $this;
    }

    // ... (rest of your existing getters and setters)

    /**
     * Get the value of earliestFeedbackDate.
     */
    public function getEarliestFeedbackDate()
    {
        return $this->earliestFeedbackDate;
    }

    /**
     * Set the value of earliestFeedbackDate.
     *
     * @param mixed $earliestFeedbackDate
     *
     * @return self
     */
    public function setEarliestFeedbackDate($earliestFeedbackDate)
    {
        $this->earliestFeedbackDate = $earliestFeedbackDate;

        return $this;
    }

    /**
     * Get the value of earliestStartingDate.
     */
    public function getEarliestStartingDate()
    {
        return $this->earliestStartingDate;
    }

    /**
     * Set the value of earliestStartingDate.
     *
     * @param mixed $earliestStartingDate
     *
     * @return self
     */
    public function setEarliestStartingDate($earliestStartingDate)
    {
        $this->earliestStartingDate = $earliestStartingDate;

        return $this;
    }

    /**
     * Get the value of appliedDate.
     */
    public function getAppliedDate()
    {
        return $this->appliedDate;
    }

    /**
     * Set the value of appliedDate.
     *
     * @param mixed $appliedDate
     *
     * @return self
     */
    public function setAppliedDate($appliedDate)
    {
        $this->appliedDate = $appliedDate;

        return $this;
    }
}
