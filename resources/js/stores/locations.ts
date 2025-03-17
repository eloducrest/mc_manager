import {defineStore} from 'pinia';
import {LocationInterface} from "@/interfaces/LocationInterface";

export const useLocationsStore = defineStore('locations', {
  state: () => ({
    locations: [] as LocationInterface[],
    selectedLocation: null as LocationInterface | null,
  }),
  actions: {
    setLocations(locations: Array<LocationInterface>) {
      this.locations = locations;
      return locations;
    }
  }
})
