/**
 * API Response Types
 */

/**
 * Boat model from API
 */
export interface Boat {
  id: number;
  nombre: string;
  imagen: string | null;
  imagen_url: string | null;
  capacidad_pasajeros: number;
  descripcion: string | null;
  activo: boolean;
  created_at: string;
  updated_at: string;
}

/**
 * Departure model from API
 */
export interface Departure {
  id: number;
  barco_id: number;
  fecha_salida: string;
  puerto_salida: string;
  itinerario_tipo: string;
  precio: number;
  created_at: string;
  updated_at: string;
  boat?: Boat;
}

/**
 * Itinerary response from /api/itinerarios/consulta
 */
export interface ItineraryResponse {
  itinerario: string;
  timezone_consulta: string;
  salidas: DepartureTime[];
  mensaje?: string;
}

/**
 * Departure with converted times
 */
export interface DepartureTime {
  barco: string;
  puerto: string;
  salida_galapagos: string;
  salida_local: string;
  retorno_galapagos: string;
  retorno_local: string;
  precio: number;
}

/**
 * API Success Response
 */
export interface ApiResponse<T> {
  success: boolean;
  data: T;
  meta?: Record<string, unknown>;
  error?: string;
}

/**
 * Itinerary Types
 */
export type ItineraryType = '4D/3N' | '5D/4N' | '8D/7N';

export const ITINERARY_TYPES: ItineraryType[] = ['4D/3N', '5D/4N', '8D/7N'];

/**
 * Timezone type
 */
export type Timezone = string;

/**
 * Hook return types
 */
export interface UseBoatsResult {
  boats: Boat[];
  loading: boolean;
  error: string | null;
}

export interface UseBoatResult {
  boat: Boat | null;
  loading: boolean;
  error: string | null;
}

export interface UseItinerariesResult {
  data: ItineraryResponse | null;
  loading: boolean;
  error: string | null;
  query: (tipo: string, timezone: string) => Promise<void>;
}

export interface UseTimezoneResult {
  timezone: Timezone;
  setTimezone: (tz: Timezone) => void;
  detected: boolean;
}