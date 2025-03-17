import {PeriodInterface} from "@/interfaces/PeriodInterface";
import {CostumeCategoryInterface} from "@/interfaces/CostumeCategoryInterface";
import {CostumeHistoryInterface} from "@/interfaces/CostumeHistoryInterface";
import {ActorInterface} from "@/interfaces/ActorInterface";

export interface CostumeInterface {
  id?: number|null,
  period_id?: number|null,
  costumes_category_id?: number|null,
  size_id?: number|null,
  location_id?: number|null,
  img_url?: File|string,
  number?: string,
  name?: string,
  description?: string,
  condition?: string,
  gender?: string,
  deposit?: number|null,
  is_to_be_repaired?: boolean,
  type?: string|null,
  period?: PeriodInterface | [],
  category?: CostumeCategoryInterface | [],
  current_costume_history?: CostumeHistoryInterface | [],
  inactive_costume_histories?: CostumeHistoryInterface | []
  associated_actor?: ActorInterface | null
}
