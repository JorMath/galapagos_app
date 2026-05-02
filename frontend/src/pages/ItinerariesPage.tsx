import { useState, type FormEvent } from 'react';
import { Link } from 'react-router-dom';
import useTimezone from '../hooks/useTimezone';
import useItineraries from '../hooks/useItineraries';
import TimezoneSelector from '../components/TimezoneSelector';
import Button from '../components/Button';
import DepartureCard from '../components/DepartureCard';
import LoadingSpinner from '../components/LoadingSpinner';
import Alert from '../components/Alert';
import Card from '../components/Card';
import type { ItineraryType } from '../types';

/**
 * ItinerariesPage - query and display itineraries with timezone conversion
 */
const ItinerariesPage = () => {
  const [selectedType, setSelectedType] = useState<ItineraryType>('5D/4N');
  const { timezone, setTimezone, detected } = useTimezone();
  const { data, loading, error, query } = useItineraries();

  const itineraryTypes: ItineraryType[] = ['4D/3N', '5D/4N', '8D/7N'];

  const handleSearch = (e: FormEvent) => {
    e.preventDefault();
    query(selectedType, timezone);
  };

  return (
    <div className="py-8">
      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-8">
          <h2 className="text-3xl font-display font-medium text-gray-900">
            Consulta Itinerarios
          </h2>
          <p className="mt-2 text-gray-500">
            Encuentra salidas y verifica los horarios en tu zona horaria
          </p>
        </div>

        <div className="mb-6">
          <Link to="/" className="btn-secondary">
            Volver a los barcos
          </Link>
        </div>

        {/* Search Form */}
        <Card className="mb-8">
          <form onSubmit={handleSearch} className="space-y-6">
            {/* Itinerary Type Selector */}
            <div>
              <p className="form-label">Tipo de Itinerario</p>
              <div className="flex flex-wrap gap-3">
                {itineraryTypes.map((type) => (
                  <button
                    key={type}
                    type="button"
                    onClick={() => setSelectedType(type)}
                    className={`px-4 py-2 rounded-lg text-sm font-medium transition-colors ${
                      selectedType === type
                        ? 'bg-primary-500 text-white'
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                    }`}
                  >
                    {type}
                  </button>
                ))}
              </div>
            </div>

            {/* Timezone Selector */}
            <TimezoneSelector
              timezone={timezone}
              setTimezone={setTimezone}
              detected={detected}
            />

            {/* Search Button */}
            <div className="flex justify-end">
              <Button type="submit" disabled={loading}>
                {loading ? 'Buscando...' : 'Buscar Itinerarios'}
              </Button>
            </div>
          </form>
        </Card>

        {/* Results */}
        {loading && (
          <div className="py-8">
            <LoadingSpinner size="large" />
          </div>
        )}

        {error && (
          <Alert variant="error" message={error} />
        )}

        {data && !loading && (
          <div>
            <div className="mb-4">
              <h3 className="text-lg font-medium text-gray-900">
                Resultados para {data.itinerario}
              </h3>
              <p className="text-sm text-gray-500">
                Zona horaria: {data.timezone_consulta}
              </p>
            </div>

            {data.salidas && data.salidas.length > 0 ? (
              <div>
                {data.salidas.map((departure, idx) => (
                  <DepartureCard key={`departure-${idx}`} departure={departure} />
                ))}
              </div>
            ) : (
              <Alert
                variant="info"
                message={data.mensaje || 'No hay salidas disponibles para este itinerario.'}
              />
            )}
          </div>
        )}
      </div>
    </div>
  );
};

export default ItinerariesPage;