import { useState } from 'react';
import type { Timezone } from '../types';

interface TimezoneSelectorProps {
  timezone: Timezone;
  setTimezone: (_tz: Timezone) => void;
  detected?: boolean;
}

/**
 * TimezoneSelector component - dropdown with detected timezone
 */
const TimezoneSelector = ({
  timezone,
  setTimezone,
  detected = false,
}: TimezoneSelectorProps) => {
  const [isOpen, setIsOpen] = useState(false);

  // Common timezones for the region
  const timezones: Timezone[] = [
    'America/Guayaquil',
    'America/New_York',
    'America/Los_Angeles',
    'America/Chicago',
    'America/Denver',
    'America/Bogota',
    'America/Lima',
    'America/Santiago',
    'America/Mexico_City',
    'Europe/Madrid',
    'Europe/London',
    'Europe/Paris',
  ];

  const handleSelect = (tz: Timezone) => {
    setTimezone(tz);
    setIsOpen(false);
  };

  return (
    <div className="relative">
      <label className="form-label">
        Zona Horaria
        {detected && (
          <span className="ml-2 text-xs text-gray-500">(detectado automáticamente)</span>
        )}
      </label>
      <button
        type="button"
        onClick={() => setIsOpen(!isOpen)}
        className="form-input flex items-center justify-between text-left"
      >
        <span>{timezone}</span>
        <svg
          className={`w-5 h-5 text-gray-400 transition-transform ${isOpen ? 'rotate-180' : ''}`}
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      {isOpen && (
        <div className="absolute z-10 w-full mt-1 bg-white border border-border rounded-lg shadow-lg max-h-60 overflow-auto">
          {timezones.map((tz) => (
            <button
              key={tz}
              type="button"
              onClick={() => handleSelect(tz)}
              className={`w-full px-4 py-2 text-left text-sm hover:bg-gray-50 ${
                tz === timezone ? 'bg-primary-50 text-primary-700 font-medium' : 'text-gray-700'
              }`}
            >
              {tz}
            </button>
          ))}
        </div>
      )}
    </div>
  );
};

export default TimezoneSelector;