import moment from "moment";

moment.locale('fr');

export function useUtils() {

  const formatDate = (date: string|Date, format: string = 'DD/MM/YYYY') => {
    return moment(date).format(format);
  }

  const scrollToRef = (ref: any) => {
    ref.scrollIntoView({ behavior: 'smooth' });
  }

  return {
    formatDate,
    scrollToRef
  }
}
