import {CostumeInterface} from "@/interfaces/CostumeInterface";

export interface CostumeCategoryInterface {
  id?: number|null,
  name: string,
  label: string,
  costumes?: Array<CostumeInterface>|[],
  created_at: string
  updated_at: string
  deleted_at?: string|null
}
