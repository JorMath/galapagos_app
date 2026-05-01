import api from './api';
import type { ApiResponse, Boat } from '../types';

/**
 * Get all active boats
 */
export const getBoats = async (): Promise<ApiResponse<Boat[]>> => {
  const response = await api.get<ApiResponse<Boat[]>>('/api/barcos');
  return response.data;
};

/**
 * Get a single boat by ID
 */
export const getBoat = async (id: number): Promise<ApiResponse<Boat>> => {
  const response = await api.get<ApiResponse<Boat>>(`/api/barcos/${id}`);
  return response.data;
};