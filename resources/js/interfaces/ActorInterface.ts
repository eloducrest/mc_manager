import {CostumeInterface} from "@/interfaces/CostumeInterface";

export interface ActorInterface {
  id: number|null,
  lastname: string,
  firstname: string,
  email: string,
  tel: string,
  address: string,
  zip_code: string,
  city: string,
  is_volunteer: boolean,
  size: string,
  shoe_size: string,
  costumes: CostumeInterface[] | [],
  current_costumes: CostumeInterface[] | [],
  past_costume_histories: CostumeInterface[] | [],
}
