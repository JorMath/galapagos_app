import { useState, useEffect } from 'react';
import { getBoats, getBoat } from '../services/boatService';
import type { Boat, UseBoatsResult, UseBoatResult } from '../types';

/**
 * Hook to fetch all active boats
 */
const useBoats = (): UseBoatsResult => {
  const [boats, setBoats] = useState<Boat[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchBoats = async () => {
      try {
        setLoading(true);
        const response = await getBoats();
        if (response.success) {
          setBoats(response.data);
        } else {
          setError(response.error || 'Error al cargar los barcos');
        }
      } catch (err) {
        setError(err instanceof Error ? err.message : 'Error al cargar los barcos');
      } finally {
        setLoading(false);
      }
    };

    fetchBoats();
  }, []);

  return { boats, loading, error };
};

/**
 * Hook to fetch a single boat by ID
 */
const useBoat = (id: number): UseBoatResult => {
  const [boat, setBoat] = useState<Boat | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    if (!id) return;

    const fetchBoat = async () => {
      try {
        setLoading(true);
        const response = await getBoat(id);
        if (response.success) {
          setBoat(response.data);
        } else {
          setError(response.error || 'Error al cargar el barco');
        }
      } catch (err) {
        setError(err instanceof Error ? err.message : 'Error al cargar el barco');
      } finally {
        setLoading(false);
      }
    };

    fetchBoat();
  }, [id]);

  return { boat, loading, error };
};

export { useBoats, useBoat };
export default useBoats;