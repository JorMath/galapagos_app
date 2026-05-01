import api from './api';
import type { ApiResponse, ItineraryResponse, Departure, ItineraryType, Timezone } from '../types';

/**
 * Query itineraries by type and timezone
 */
export const queryItineraries = async (
  tipo: ItineraryType,
  timezone: Timezone
): Promise<ApiResponse<ItineraryResponse>> => {
  const response = await api.get<ApiResponse<ItineraryResponse>>('/api/itinerarios/consulta', {
    params: { tipo, timezone },
  });
  return response.data;
};

/**
 * Get all departures
 */
export const getDepartures = async (): Promise<ApiResponse<Departure[]>> => {
  const response = await api.get<ApiResponse<Departure[]>>('/api/salidas');
  return response.data;
};