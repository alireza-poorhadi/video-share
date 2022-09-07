<?php

namespace App\Observers;

use App\Models\Like;
use Illuminate\Support\Facades\Cache;
use App\Notifications\ResourceWasLiked;

class LikeObserver
{
    /**
     * Handle the Like "created" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function created(Like $like)
    {
        $likingName = $like->user->name;
        $likeable = $like->likeable;

        $this->deleteCache($likeable);

        if ($like->vote == 1) {
            $likeable->user->notify(new ResourceWasLiked($likeable, $likingName));
        }
    }

    /**
     * Handle the Like "updated" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function updated(Like $like)
    {
        //
    }

    /**
     * Handle the Like "deleted" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function deleted(Like $like)
    {
        $likeable = $like->likeable;

        $this->deleteCache($likeable);
    }

    /**
     * Handle the Like "restored" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function restored(Like $like)
    {
        //
    }

    /**
     * Handle the Like "force deleted" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function forceDeleted(Like $like)
    {
        //
    }

    private function deleteCache($likeable)
    {
        $cacheKeyNameForLikes = 'likes_count_for_' . class_basename($likeable) . '_' . $likeable->id;
        Cache::forget($cacheKeyNameForLikes);

        $cacheKeyNameForDisikes = 'dislikes_count_for_' . class_basename($likeable) . '_' . $likeable->id;
        Cache::forget($cacheKeyNameForDisikes);
    }
}
