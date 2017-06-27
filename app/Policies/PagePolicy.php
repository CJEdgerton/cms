<?php

namespace App\Policies;

use App\User;
use App\Page;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    /**
     * Determines if a user is the owner of a page or an admin.
     *
     * @param      \App\User  $user   The user
     * @param      \App\Page  $page   The page
     *
     * @return     boolean    True if owner or admin, False otherwise.
     */
    private function isOwnerOrAdmin(User $user, Page $page)
    {
        return $user->is_admin || $page->created_by === $user->id;
    }

    private function isCollaborator(User $user, Page $page)
    {
        return in_array( $user->id, $page->collaborators->pluck('id')->toArray() );
    }

    /**
     * Determine whether the user can view the page.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function view(User $user, Page $page)
    {
        return $this->isOwnerOrAdmin($user, $page);
    }

    /**
     * Determine whether the user can create pages.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the page.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function update(User $user, Page $page)
    {
        return $this->isOwnerOrAdmin($user, $page) || $this->isCollaborator($user, $page);
    }

    /**
     * Determine whether the user can delete the page.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function delete(User $user, Page $page)
    {
        return $this->isOwnerOrAdmin($user, $page);
    }
}
