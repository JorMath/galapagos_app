import { Link } from 'react-router-dom';
import useBoats from '../hooks/useBoats';
import BoatCard from '../components/BoatCard';
import LoadingSpinner from '../components/LoadingSpinner';
import Alert from '../components/Alert';

/**
 * HomePage - displays list of active boats
 */
const HomePage = () => {
  const { boats, loading, error } = useBoats();

  if (loading) {
    return (
      <div className="py-12">
        <LoadingSpinner size="large" />
      </div>
    );
  }

  if (error) {
    return (
      <div className="py-8">
        <Alert variant="error" message={error} />
        <div className="mt-4 text-center">
          <Link to="/" className="text-primary-500 hover:text-primary-600">
            Intentar de nuevo
          </Link>
        </div>
      </div>
    );
  }

  return (
    <div className="py-8">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-8">
          <h2 className="text-3xl font-display font-medium text-gray-900">
            Explora los Barcos de Galápagos
          </h2>
          <p className="mt-2 text-gray-500">
            Descubre nuestra flota de barcos para tu próxima aventura
          </p>
        </div>

        {boats.length === 0 ? (
          <Alert
            variant="info"
            message="No hay barcos disponibles en este momento."
          />
        ) : (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {boats.map((boat) => (
              <BoatCard key={boat.id} boat={boat} />
            ))}
          </div>
        )}

        <div className="mt-8 text-center">
          <Link
            to="/itineraries"
            className="inline-flex items-center text-primary-500 hover:text-primary-600"
          >
            Ver itinerarios disponibles →
          </Link>
        </div>
      </div>
    </div>
  );
};

export default HomePage;