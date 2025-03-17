import {CostumeInterface} from "@/interfaces/CostumeInterface";

export interface LocationInterface {
  id: number,
  name: number,
  label: number,
  description: number,
  code: string,
  costumes?: Array<CostumeInterface>,
  created_at: string
  updated_at: string
  deleted_at?: string
}
