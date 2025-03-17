export interface UserInterface {
  id?: number|null,
  lastname: string,
  firstname: string,
  role: string,
  function: string,
  email: string,
  tel: string,
  img_profile: string|File|null,
  created_at: string
  updated_at: string
  deleted_at?: string|null
}
