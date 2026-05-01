import { useState, useEffect, useCallback } from 'react';
import type { Timezone, UseTimezoneResult } from '../types';

/**
 * Hook to detect and manage user timezone
 * Auto-detects timezone using Intl API, allows manual override
 */
const useTimezone = (): UseTimezoneResult => {
  const getInitialTimezone = (): Timezone => {
    // Check localStorage first for manual override
    const stored = localStorage.getItem('user_timezone');
    if (stored) return stored;

    // Auto-detect using Intl API
    try {
      return Intl.DateTimeFormat().resolvedOptions().timeZone;
    } catch {
      return 'America/Guayaquil'; // Default fallback
    }
  };

  const [timezone, setTimezoneState] = useState<Timezone>(getInitialTimezone);
  const [detected, setDetected] = useState<boolean>(!localStorage.getItem('user_timezone'));

  const setTimezone = useCallback((newTimezone: Timezone) => {
    setTimezoneState(newTimezone);
    localStorage.setItem('user_timezone', newTimezone);
    setDetected(false);
  }, []);

  // Update detected status when timezone changes from auto-detection
  useEffect(() => {
    if (!localStorage.getItem('user_timezone')) {
      setDetected(true);
    }
  }, []);

  return { timezone, setTimezone, detected };
};

export default useTimezone;