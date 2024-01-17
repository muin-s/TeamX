<?php

namespace App\Entities1;

use Illuminate\Contracts\Support\Arrayable;

class EducationExpSkill1 implements Arrayable
{
    protected $learningWeightPct;
    protected $startedDate;
    protected $endedDate;
    protected $learnedSkill;
    protected $learnedAtEducation;

    public function toArray() {

        $output = [];

        foreach ( get_class_vars(get_class($this)) as $propName => $propDefaultValue ) {
            $output[ $propName ] = $this->{$propName};
        }

        return $output;

    }
}
