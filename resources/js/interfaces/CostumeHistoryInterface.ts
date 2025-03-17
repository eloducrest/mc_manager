export interface CostumeHistoryInterface {
  id?: number,
  actor_id: number|null,
  costume_id: number,
  amount_deposit?: number|null,
  return_condition?: string|null,
  returned_at?: string,
  amount_returned_deposit?: number|null,
  is_to_be_repaired?: boolean,
  comments?: string
}
