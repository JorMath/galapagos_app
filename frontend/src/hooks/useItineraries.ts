import { useState, useCallback } from 'react';
import { queryItineraries } from '../services/itineraryService';
import type { ItineraryResponse, UseItinerariesResult } from '../types';

/**
 * Hook to query itineraries by type and timezone
 */
const useItineraries = (): UseItinerariesResult => {
  const [data, setData] = useState<ItineraryResponse | null>(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  const query = useCallback(async (itineraryType: string, userTimezone: string) => {
    if (!itineraryType || !userTimezone) {
      setError('El tipo de itinerario y la zona horaria son requeridos');
      return;
    }

    try {
      setLoading(true);
      setError(null);
      const response = await queryItineraries(itineraryType, userTimezone);

      if (response.success) {
        setData(response.data);
      } else {
        setError(response.error || 'Error al consultar itinerarios');
        setData(null);
      }
    } catch (err) {
      setError(err instanceof Error ? err.message : 'Error al consultar itinerarios');
      setData(null);
    } finally {
      setLoading(false);
    }
  }, []);

  return { data, loading, error, query };
};

export default useItineraries;