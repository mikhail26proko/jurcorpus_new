<?php

declare(strict_types=1);

namespace App\Orchid\Presenters;

use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Contracts\Personable;
use Orchid\Screen\Contracts\Searchable;
use Orchid\Support\Presenter;
use Laravel\Scout\Builder;

class EmployeePresenter extends Presenter implements Personable, Searchable
{
    public bool $is_deleted;

    /**
     * Returns the label for this presenter, which is used in the UI to identify it.
     */
    public function label(): string
    {
        return 'Employee';
    }

    /**
     * Returns the title for this presenter, which is displayed in the UI as the main heading.
     */
    public function title(): string
    {
        return $this->entity->full_name;
    }

    /**
     * Returns the subtitle for this presenter, which provides additional context about the user.
     */
    public function subTitle(): string
    {
        if (!empty($this->entity->job_titles)){
            return $this->entity->job_titles[0]->title;
        } else {
            return __('platform.messages.UnsetedValue');
        }
        // return '';
    }

    /**
     * Returns the URL for this presenter, which is used to link to the user's edit page.
     */
    public function url(): string
    {
        return '';
        // return route('platform.employees', $this->entity);
    }

    /**
     * Returns the URL for the user's Gravatar image, or a default image if one is not found.
     */
    public function image(): ?string
    {
        if ($this->entity->attachment_count)
        {
            return $this->entity->attachment()->first()?->url();
        } else return Attachment::find(1)->url();
    }

    /**
     * Returns the URL for the user's Gravatar image, or a default image if one is not found.
     */
    public function is_deleted(): ?bool
    {
        return !empty($this->entity->deleted_at);
    }
    /**
     * Returns the number of models to return for a compact search result.
     * This method is used by the search functionality to display a list of matching results.
     */
    public function perSearchShow(): int
    {
        return 3;
    }

    /**
     * Returns a Laravel Scout builder object that can be used to search for matching users.
     * This method is used by the search functionality to retrieve a list of matching results.
     */
    public function searchQuery(string $query = null): Builder
    {
        return $this->entity->search($query);
    }
}
