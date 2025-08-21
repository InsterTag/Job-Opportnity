<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobApplication;

class JobApplicationPolicy
{
    public function updateStatus(User $user, JobApplication $application)
    {
        return $user->isCompany() && $user->company && $application->jobOffer->company_id === $user->company->id;
    }

    public function downloadCv(User $user, JobApplication $application)
    {
        $isOwner = $user->unemployed && $application->unemployed_id == $user->unemployed->id;
        $isCompany = $user->isCompany() && $user->company && $application->jobOffer->company_id == $user->company->id;
        return $isOwner || $isCompany;
    }
}
