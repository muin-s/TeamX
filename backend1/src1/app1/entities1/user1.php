<?php

namespace App\Entities;

use Illuminate\Contracts\Support\Arrayable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Entities\JobPosting;
use App\Entities\JobExperience;
use App\Entities\Education;
use App\Entities\SkillCategory;
use App\Entities\Skill;

class User extends Authenticatable implements Arrayable, JWTSubject
{
    protected $id;
    protected $email;
    protected $password;
    protected $firstName;
    protected $lastName;
    protected $rememberToken;

    /** @var Education[] */
    protected $educations;

    /** @var Skill[] */
    protected $skills;

    /** @var SkillCategory[] */
    protected $skillCategories;

    /** @var JobPosting[] */
    protected $jobPostings;

    /** @var JobExperience[] */
    protected $jobExperiences;

    public function toArray()
    {
        return [
            'email' => $this->getEmail(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
        ];
    }

    // Rest omitted for brevity

    /**
     * Get [];
     *
     * @return  JobExperience[]
     */
    public function getJobExperiences()
    {
        return $this->jobExperiences;
    }

    /**
     * Set [];
     *
     * @param  JobExperience[]  $jobExperiences
     * @return  self
     */
    public function setJobExperiences(array $jobExperiences)
    {
        $this->jobExperiences = $jobExperiences;
        return $this;
    }

    /**
     * Get [];
     *
     * @return  JobPosting[]
     */
    public function getJobPostings()
    {
        return $this->jobPostings;
    }

    /**
     * Set [];
     *
     * @param  JobPosting[]  $jobPostings
     * @return  self
     */
    public function setJobPostings(array $jobPostings)
    {
        $this->jobPostings = $jobPostings;
        return $this;
    }
}
