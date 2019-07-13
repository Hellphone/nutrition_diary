<?php

namespace App\Policies;

use App\User;
use App\Record;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecordPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view the record.
     *
     * @param  \App\User  $user
     * @param  \App\Record  $record
     * @return mixed
     */
    public function update(User $user, Record $record)
    {
        return $record->owner_id == $user->id;
    }
}
