<?php

namespace App\Listeners;

use App\Events\SetToBeRepairedCostumeEvent;
use App\Models\Costume;
use App\Models\RepairHistory;

class SetToBeRepairedCostumeListener
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
  public function handle(SetToBeRepairedCostumeEvent $event): void
  {
    Costume::find($event->costumeHistory->costume_id)
      ->update([
        'is_to_be_repaired' => $event->costumeHistory->is_to_be_repaired
      ]);

    RepairHistory::create([
      'costume_id' => $event->costumeHistory->costume_id,
      'repair_comment' => $event->costumeHistory->comments,
      'condition_before_repair' => $event->costumeHistory->return_condition,
    ]);
  }
}
