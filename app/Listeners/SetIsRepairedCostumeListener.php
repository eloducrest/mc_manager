<?php

namespace App\Listeners;

use App\Events\SetIsRepairedCostumeEvent;
use App\Models\Costume;

class SetIsRepairedCostumeListener
{
  /**
   * Create the event listener.
   */
  public function __construct()
  {
    //
  }

  /**
   * Handle the event.
   */
  public function handle(SetIsRepairedCostumeEvent $event): void
  {
    //dd($request);
    Costume::find($event->repairHistory->costume_id)
      ->update([
        'condition' => $event->repairHistory->condition_after_repair,
        'is_to_be_repaired' => false
      ]);

    $event->repairHistory->update([
      'condition_after_repair' => $event->repairHistory->condition_before_repair,
      'resolved_comment' => $event->repairHistory->resolved_comment
    ]);

    $event->repairHistory->delete();
  }
}
